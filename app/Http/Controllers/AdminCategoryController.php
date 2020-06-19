<?php

namespace App\Http\Controllers;

use App\categoty;
use App\subcategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    function Index(){

        $data = categoty::select()->paginate(25);
        return view('backend.category',['data'=>$data]);
    }

    function Add(Request $request){
        $c_directtory = getcwd();
        $request->validate([
            'cat_name' => 'required',
            'cat_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cat_color' => 'required',
        ]);

        $name = "";
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move($c_directtory.'/storage/photos/', $name);
        }else{
            return back()->with('error', 'SORRY - Category Image Required.');
        }


        categoty::insert([
            'name' => $request->cat_name,
            'status' => '1',
            'cat_id' => substr($request->cat_name,0,3),
            'cat_img' => $name,
            'cat_color' => $request->cat_color,
        ]);
        return back()->with('success', 'SUCCESS - Category Added Successfully.');
    }

    function Update($id , Request $request){

        $request->validate([
            'cat_name' => 'required',
            'cat_color' => 'required',
            'cat_id' => 'required',
        ]);
        if(empty($request->cat_img)){
            categoty::findOrFail($id)->update([
                'name' => $request->cat_name,
                'status' => '1',
                'cat_color' => $request->cat_color,
                'cat_id' => $request->cat_id,
            ]);
        }else{
            $c_directtory = getcwd();
            $old_img = categoty::findOrFail($id)->cat_img;
            $name = "";
            if ($request->hasFile('cat_img')) {
                $image = $request->file('cat_img');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move($c_directtory.'/storage/photos/', $name);
            }else{
                return back()->with('error', 'SORRY - Category Image Required.');
            }

            categoty::where('id', $id)->update([
                'name' => $request->cat_name,
                'status' => '1',
                'cat_img' => $name,
                'cat_color' => $request->cat_color,
                'cat_id' => $request->cat_id,
            ]);
            unlink('storage/photos/'.$old_img);
        }
        return back();
    }

    function Drop($id){
        //delete img
        $old_img = categoty::findOrFail($id)->cat_img;
        if (file_exists('storage/photos/'.$old_img)) {
            unlink('storage/photos/'.$old_img);
        }
        categoty::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted Successfully.');
    }
}
