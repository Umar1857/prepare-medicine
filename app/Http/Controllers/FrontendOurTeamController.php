<?php

namespace App\Http\Controllers;

use App\feedback;
use App\News;
use App\Team;
use App\ui_team_work;
use Illuminate\Http\Request;

class FrontendOurTeamController extends Controller
{

    function Index(){

        $data = ui_team_work::findOrFail(8)->content;
        $team_members = Team::all();
        return view('frontend.our-team',['data'=>$data, 'team_members' => $team_members]);
    }

    function Volunteer(){

        $data = ui_team_work::findOrFail(9)->content;
        return view('frontend.volunteer',['data'=>$data]);
    }

    function PlabExam(){
        $data = ui_team_work::findOrFail(1)->content;
        return view('frontend.about-plab-exam',['data'=>$data]);
    }

    function PlabNews(){

        //$data = ui_team_work::findOrFail(5)->content;
        //return view('frontend.plab-news-updates',['data'=>$data]);

        $blogs = News::orderBy('id', 'DESC')->paginate(30);
        return view('frontend.plab-news-updates', compact('blogs'));
    }

    function Feedback(){
        $data = feedback::select()->where('status',"1")->paginate(25);
        return view('frontend.feedback',['data'=>$data]);
    }

    function FeedbackEdit($id){
        $old_data = feedback::findOrFail($id);
        $data     = feedback::select()->where('status',"1")->get();
        return view('frontend.feedback-edit',['data'=>$data ,'old_data'=>$old_data]);
    }

    function LinksPlab1(){

        $data = ui_team_work::findOrFail(2)->content;
        return view('frontend.links-plab-1',['data'=>$data ]);
    }

    function WorkUs(){

        $data = ui_team_work::findOrFail(3)->content;
        return view('frontend.work-us',['data'=>$data]);
    }

    function Disclaimer(){

        $data = ui_team_work::findOrFail(4)->content;
        return view('frontend.disclaimer',['data'=>$data]);
    }

    function terms_conditons(){
        return view('frontend.terms-conditions');
    }

    function FAQ(){

        $data = ui_team_work::findOrFail(6)->content;
        return view('frontend.faq',['data'=>$data]);
    }

    function LabValue(){

        $data = ui_team_work::findOrFail(10)->content;
        return view('frontend.lab-value',['data'=>$data]);
    }
}
