<?php

namespace App\Http\Controllers;

use App\categoty;
use App\community;
use App\user_question;
use App\user_answer;
use App\user_revision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    function Index_Whatsapp(){

        $data = community::select()->where('status',"1")->paginate(25);
        return view('backend.whatsapp',['data'=>$data]);
    }

    function Index_Facebook(){

        $data = community::select()->where('status',"2")->paginate(25);
        return view('backend.facebook',['data'=>$data]);
    }

    function WhatsappAdd(Request $request){
        $c_directtory = getcwd();
        $request->validate([
            'name' => "required",
            'link' => "required",
            'cat_img' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $name = "";
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move($c_directtory.'/storage/community-groups/', $name);
        }else{
            return back()->with('error', 'SORRY - Image Required.');
        }

        community::insert([
            'name' => $request->name,
            'link' => $request->link,
            'cat_img' => $name,
            'status' => '1',
        ]);
        return back()->with('success',"You added a Whatsapp Group !!");
    }

    function WhatsappEdit(Request $request, $id){

        $request->validate([
            'name' => "required",
            'link' => "required",
        ]);


        if(empty($request->cat_img)){
            community::where('id',$id)->update([
                'name' => $request->name,
                'link' => $request->link,
            ]);
        }else{
            $c_directtory = getcwd();
            $old_img = community::findOrFail($id)->cat_img;
            $name = "";
            if ($request->hasFile('cat_img')) {
                $image = $request->file('cat_img');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move($c_directtory.'/storage/community-groups/', $name);
            }else{
                return back()->with('error', 'SORRY - Image Required.');
            }

            community::where('id',$id)->update([
                'name' => $request->name,
                'link' => $request->link,
                'cat_img' => $name,
            ]);
            if($old_img){
                unlink('storage/community-groups/'.$old_img);
            }
        }
        return back()->with('success', 'SUCCESS - Data updated');

    }

    function FacebookpAdd(Request $request){

        $c_directtory = getcwd();
        $request->validate([
            'name' => "required",
            'link' => "required",
            'cat_img' => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);

        $name = "";
        if ($request->hasFile('cat_img')) {
            $image = $request->file('cat_img');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $image->move($c_directtory.'/storage/community-groups/', $name);
        }else{
            return back()->with('error', 'SORRY - Image Required.');
        }

        community::insert([
            'name' => $request->name,
            'link' => $request->link,
            'cat_img' => $name,
            'status' => '2',
        ]);
        return back()->with('success',"You added a Facebook Group !!");
    }

    function FacebookEdit(Request $request, $id){

        $request->validate([
            'name' => "required",
            'link' => "required",
        ]);


        if(empty($request->cat_img)){
            community::where('id',$id)->update([
                'name' => $request->name,
                'link' => $request->link,
            ]);
        }else{
            $c_directtory = getcwd();
            $old_img = community::findOrFail($id)->cat_img;
            $name = "";
            if ($request->hasFile('cat_img')) {
                $image = $request->file('cat_img');
                $name = uniqid().'.'.$image->getClientOriginalExtension();
                $image->move($c_directtory.'/storage/community-groups/', $name);
            }else{
                return back()->with('error', 'SORRY - Image Required.');
            }

            community::where('id',$id)->update([
                'name' => $request->name,
                'link' => $request->link,
                'cat_img' => $name,
            ]);
            if($old_img){
                unlink('storage/community-groups/'.$old_img);
            }
        }
        return back()->with('success', 'SUCCESS - Data updated');
    }

    function CommunityCommunity($id){
        if(Auth::user()->role == '4'){
            $data = community::where('id',$id)->first();
            if(file_exists('storage/community-groups/'.$data->cat_img)){
                unlink('storage/community-groups/'.$data->cat_img);
            }
            community::where('id',$id)->delete();
        }
        return back()->with('success',"You Deleted a Group !!");
    }



    //get plab community questions list for admin view
    function getCommunityQuestionsList(){

        $category = categoty::select()->get();
        $data = user_question::orderBy('id', 'DESC')
                    ->with('get_user_info')
                    ->paginate(30);
        return view('backend.plab-community-questions-list',['data'=>$data,'category'=>$category]);
    }

    //get plab community questions list for admin view
    function communityQuestionReject($id){

        user_question::where('id', $id)->delete();

        $data_list = user_answer::where('ques_id', $id)->get();
        if(!$data_list->isEmpty()){
            foreach($data_list as $value){
                user_answer::where('id', $value->id)->delete();
            }
        }

        $data_list__r = user_revision::where('ques_id', $id)->get();
        if(!$data_list__r->isEmpty()){
            foreach($data_list__r as $value){
                user_revision::where('id', $value->id)->delete();
            }
        }

        return back()->with('success', 'Question Deleted');
    }
}
