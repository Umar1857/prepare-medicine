<?php

namespace App\Http\Controllers;

use App\question;
use App\recallmodel;
use Illuminate\Http\Request;

class Recall extends Controller
{
    function Index(){
        $data = recallmodel::all();

        return view('backend.recall',['data'=>$data]);
    }

    function Add(Request $request){

        $request->validate([
            'name' => 'required',
            'month' => "required",
            'cat_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cat_color' => 'required',
        ]);

        $name = "";
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(env('STORAGE_PATH').'/photos/', $name);
        }else{
            return back()->with('error', 'SORRY - Category Image Required.');
        }

        recallmodel::insert([
            'name' => $request->name,
            'exam_month' => $request->month,
            'cat_img' => $name,
            'cat_color' => $request->cat_color,
        ]);
        return back()->with('success', 'SUCCESS - Category Added Successfully.');

    }

    function Edit(Request $request , $id){

        $request->validate([
            'name' => 'required',
            'month' => 'required',
            'cat_color' => 'required',
        ]);

        if(empty($request->cat_img)){
            recallmodel::where('id', $id)->update([
                'name' => $request->name,
                'exam_month' => $request->month,
                'cat_color' => $request->cat_color,
            ]);
        }else{
            $old_img = recallmodel::findOrFail($id)->cat_img;
            $name = "";
            if ($request->hasFile('cat_img')) {
                $image = $request->file('cat_img');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move(env('STORAGE_PATH').'/photos/', $name);
            }else{
                return back()->with('error', 'SORRY - Category Image Required.');
            }

            recallmodel::where('id', $id)->update([
                'name' => $request->name,
                'exam_month' => $request->month,
                'cat_img' => $name,
                'cat_color' => $request->cat_color,
            ]);
            if ($old_img) {
                unlink(public_path('storage/photos/'.$old_img));
            }

        }
        return back()->with('success', 'Category Updated Successfully.');

    }

    function Drop($id){
        $old_img = recallmodel::findOrFail($id)->cat_img;
        if (file_exists(public_path('storage/photos/'.$old_img))) {
            unlink(public_path('storage/photos/'.$old_img));
        }

        question::where('status',$id)->delete();
        recallmodel::where('id',$id)->delete();

        return back();
    }
}
