<?php

namespace App\Http\Controllers;

use App\mockquestion;
use App\mockinformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MockCompareController extends Controller
{
    function Single(Request $request){

        if(empty($request->answer) && $request->answer != '0'){
            return back()->withErrors('You have to check a answer !!');
        }

        $main_ans = mockquestion::findOrFail($request->question_id)->ans;
        if ($main_ans == $request->answer) {
            mockquestion::findOrFail($request->question_id)->update([
                'status' => '1',
                'user_ans' => $request->answer,
            ]);
            mockinformation::where('exam_id',$request->exam_id)->increment('right_ans',1);
        } else {
            mockquestion::findOrFail($request->question_id)->update([
                'status' => '2',
                'user_ans' => $request->answer,
            ]);
            mockinformation::where('exam_id',$request->exam_id)->increment('wrong_ans',1);
        }
        mockinformation::where('exam_id',$request->exam_id)->update([
            'time' => $request->input_time,
        ]);

        // time contert
        $fetch_time = mockinformation::select()->where('exam_id',$request->exam_id)->get()[0]->time;
        $array_time = explode(':',$fetch_time);
        $count_down = $array_time[0]*60*60+($array_time[1]*60) +($array_time[2]);

        if ( $request->page == '0' ) {
            return back()->with(['count_down'=>$count_down]);
        } else {
            return Redirect::to($request->page)->with(['count_down'=>$count_down]);
        }

    }

    function Multi(Request $request){

        if(empty($request->answer)){
            return back()->withErrors('You have to check one or more answer !!');
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }
        $main_ans = mockquestion::findOrFail($request->question_id)->ans;
        if ($main_ans == $answer) {
            mockquestion::findOrFail($request->question_id)->update([
                'status' => '1',
                'user_ans' => $answer,
            ]);
            mockinformation::where('exam_id',$request->exam_id)->increment('right_ans',1);
        } else {
            mockquestion::findOrFail($request->question_id)->update([
                'status' => '2',
                'user_ans' => $answer,
            ]);
            mockinformation::where('exam_id',$request->exam_id)->increment('wrong_ans',1);
        }
        mockinformation::where('exam_id',$request->exam_id)->update([
            'time' => $request->input_time,
        ]);
        // time contert
        $fetch_time = mockinformation::select()->where('exam_id',$request->exam_id)->get()[0]->time;
        $array_time = explode(':',$fetch_time);
        $count_down = $array_time[0]*60*60+($array_time[1]*60) +($array_time[2]);

        if ( $request->page == '0' ) {
            return back()->with(['count_down'=>$count_down]);
        } else {
            return Redirect::to($request->page)->with(['count_down'=>$count_down]);
        }
    }
}
