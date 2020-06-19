<?php

namespace App\Http\Controllers;

use App\question;
use App\revision;
use App\user_question;
use App\user_revision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RevisionCompareController extends Controller
{
    function Single(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }
        $main_ans = question::findOrFail($request->question_id)->ans;
        $ques_cat = question::findOrFail($request->question_id)->cat_id;
        if ($main_ans == $request->answer) {
            //correct ans
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $request->answer,
                'status' => '1',
            ]);
        } else {
            //incorrect ans
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $request->answer,
                'status' => '2',
            ]);
        }

        //auto next page off
        // if ( $request->page == '0' ) {
        //     return back();
        // } else {
        //     return Redirect::to($request->page);
        // }

        return back();
    }

    function Multi(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(empty($request->answer)){
            return back()->withErrors('You have to check one or more answer !!');
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }
        if(revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }
        $main_ans = question::findOrFail($request->question_id)->ans;
        $ques_cat = question::findOrFail($request->question_id)->cat_id;

        if ($main_ans == $answer) {
            //correct ans
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $answer,
                'status' => '1',
            ]);
        } else {
            //wrong ans
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $answer,
                'status' => '2',
            ]);
        }
        if ( $request->page == '0' ) {
            return back();
        } else {
            return Redirect::to($request->page);
        }
    }
    function UserSingle(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(user_revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }

        //count all aswers/revisions
        $totalRevision = user_revision::where('user_id',Auth::user()->id)->count();

        if (Auth::user()->role == 2 && $totalRevision == 15) {
            return redirect()->back()->with('error', "SORRY! Your Subscription Plan is Trail. So, you can't more revision.");
        }
        $main_ans = user_question::findOrFail($request->question_id)->ans;

        if ($main_ans == $request->answer) {
            user_revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'ans' => $request->answer,
                'status' => '1',
            ]);
        } else {
            user_revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'ans' => $request->answer,
                'status' => '2',
            ]);
        }
        if ( $request->page == '0' ) {
            return back();
        } else {
            return Redirect::to($request->page);
        }

    }

    function UserMulti(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(empty($request->answer)){
            return back()->withErrors('You have to check one or more answer !!');
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }
        if(user_revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }
        $main_ans = user_question::findOrFail($request->question_id)->ans;
        if ($main_ans == $answer) {
            user_revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'ans' => $answer,
                'status' => '1',
            ]);
        } else {
            user_revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'ans' => $answer,
                'status' => '2',
            ]);
        }
        if ( $request->page == '0' ) {
            return back();
        } else {
            return Redirect::to($request->page);
        }
    }

    function RecallSingle(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }
        $main_ans = question::findOrFail($request->question_id)->ans;
        $ques_cat = question::findOrFail($request->question_id)->cat_id;

        if ($main_ans == $request->answer) {
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $request->answer,
                'status' => '1',
                'type' => '1',
            ]);
        } else {
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $request->answer,
                'status' => '2',
                'type' => '1',
            ]);
        }

        //stop the automatically next question
        // if ( $request->page == '0' ) {
        //     return back();
        // } else {
        //     return Redirect::to($request->page);
        // }
        return back();
    }

    function RecallMulti(Request $request){

        $request->validate([
            'question_id' => "required",
            'answer' => "required",
        ]);
        if(empty($request->answer)){
            return back()->withErrors('You have to check one or more answer !!');
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }
        if(revision::where('user_id',Auth::user()->id)->where('ques_id',$request->question_id)->exists()){
            return back()->with('error',"You are already test it !!");
        }
        $main_ans = question::findOrFail($request->question_id)->ans;
        $ques_cat = question::findOrFail($request->question_id)->cat_id;

        if ($main_ans == $answer) {
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $answer,
                'status' => '1',
                'type' => '1',
            ]);
        } else {
            revision::insert([
                'user_id' => Auth::user()->id,
                'ques_id' => $request->question_id,
                'cat_id' => $ques_cat, //category id of Question
                'ans' => $answer,
                'status' => '2',
                'type' => '1',
            ]);
        }
        if ( $request->page == '0' ) {
            return back();
        } else {
            return Redirect::to($request->page);
        }
    }
}
