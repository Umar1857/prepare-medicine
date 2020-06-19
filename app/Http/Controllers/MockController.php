<?php

namespace App\Http\Controllers;

use App\question;
use App\mockquestion;
use App\ui_team_work;
use App\mockinformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MockController extends Controller
{
    function Random(){

        if(Auth::user()->role == 1 || Auth::user()->role == 4){
            //not verified or admin
            return back();
        }

        if (Auth::user()->role >= 2 && Auth::user()->expeir_date > date('Y-m-d')) {
            $continue_data = mockinformation::select()->where('user_id', Auth::user()->id)
                                            ->where('status', '1')->get();
            $exists_data = mockinformation::where('user_id', Auth::user()->id)->where('status', '1')
                                            ->where('type', '1')->count();
            if ($exists_data != '0') {
                foreach ($continue_data as $key => $value) {
                    return redirect('q-bank/random/exam/'.$value->id);
                }
            }


            $exam_time__ = NULL;
            $fetch_question = NULL;
            if (Auth::user()->role == 2) {
                //trial
                if( !empty(question::all()) && question::where('status','0')->orderBy('id', 'ASC')->count() >= 20){
                    $fetch_question = question::select()->where('status','0')->orderBy('id', 'ASC')->take(20)->get()->random(20);
                    $exam_time__ = 20*60;
                }else{
                    return back()->with('error',"Insufficient Questions For Exam");
                }
            }else{
                if( !empty(question::all()) && question::where('status','0')->count() >= 180){
                    $fetch_question = question::select()->where('status','0')->get()->random(180);
                    $exam_time__ = 180*60;
                }else{
                    return back()->with('error',"Insufficient Questions For Exam");
                }
            }


            $exam_id = time();
            $user_id = Auth::user()->id;
            foreach ($fetch_question as $value) {
                mockquestion::insert([
                    'exam_id' => $exam_id,
                    'user_id' => $user_id,
                    'ques_id' => $value->id,
                    'question' => $value->question,
                    'cat_id' => $value->cat_id,
                    'ans' => $value->ans,
                    'explanation' => $value->explanation,
                    'hint' => $value->hint,
                    'search_id' => $value->search_id,
                    'type' => $value->type,
                ]);
            }
            $id = mockinformation::insertGetId([
                'user_id' =>$user_id,
                'exam_id' =>$exam_id,
                'time' =>$exam_time__,
                'wrong_ans' =>0,
                'right_ans' =>0,
            ]);
        }else{
            return redirect('/');
        }

        return redirect('q-bank/random/exam/'.$id);
    }

    function Manual(Request $request){

        if(Auth::user()->role == 1 || Auth::user()->role == 4){
            //no access for non-verified and admin
            return back();
        }elseif(Auth::user()->role == 2){
            //trial no acces
            return redirect()->back()
                    ->with('no_access_permission__', 'You can not access, please upgrade your plan');
        }



        if (Auth::user()->role >= 3 && Auth::user()->expeir_date > date('Y-m-d')) {
            $continue_data = mockinformation::select()->where('user_id',Auth::user()->id)->where('status','1')->get();
            $exists_data = mockinformation::where('user_id',Auth::user()->id)->where('status','1')->where('type',"2")->count();
            if ($exists_data != '0') {
                foreach ($continue_data as $key => $value) {
                    return redirect('q-bank/manual/exam/'.$value->id);
                }
            }

            $fetch_question = NULL;
            if ($request->type == 'cat') {
                if( !empty(question::whereIn('cat_id',$request->search)->get()->toArray()) && question::whereIn('cat_id',$request->search)->count() >= 180){

                    $fetch_question = question::whereIn('cat_id',$request->search)->get()->random(180);

                }else{
                    return back()->with('error',"Insufficient Questions in your Selected Categories");
                }
            }elseif($request->type == 'subcat'){
                if( !empty(question::where('subcat_id',$request->search)->get()->toArray()) && question::where('subcat_id',$request->search)->count() >= 3){
                    if (Auth::user()->role == 2) {
                        //trail
                        $fetch_question = question::where('subcat_id',$request->search)->get()->random(3);
                    }else{
                        $fetch_question = question::where('subcat_id',$request->search)->get()->random(3);
                    }
                }else{
                    return back()->with('error',"Insufficient Questions in your Selected SubCategories");
                }
            }

            $exam_id = time();
            $user_id = Auth::user()->id;
            foreach($fetch_question as $value){
                mockquestion::insert([
                    'exam_id' => $exam_id,
                    'user_id' => $user_id,
                    'ques_id' => $value->id,
                    'question' => $value->question,
                    'cat_id' => $value->cat_id,
                    // 'subcat_id' => $value->subcat_id,
                    'ans' => $value->ans,
                    'explanation' => $value->explanation,
                    'hint' => $value->hint,
                    'search_id' => $value->search_id,
                    'type' => $value->type,
                ]);
            }
            $id = mockinformation::insertGetId([
                'user_id' =>$user_id,
                'exam_id' =>$exam_id,
                'time' =>180*60,
                'wrong_ans' =>0,
                'right_ans' =>0,
                'type' =>2,
            ]);
        }else{
            return redirect('/');
        }

        return redirect('q-bank/manual/exam/'.$id);
    }

    function RandomExam($id){

        if (mockinformation::findOrFail($id)->time == '0') {
            return redirect('q-bank/random/exam/result/'.$id);
        }

        $exam_id = mockinformation::findOrFail($id)->exam_id;
        $data = mockquestion::select()->where('exam_id',$exam_id)->simplePaginate(1);
        $mark = mockquestion::select()->where('exam_id',$exam_id)->get();
        $total_question = mockquestion::where('exam_id',$exam_id)->count();
        $lab = ui_team_work::findOrFail(10)->content;
        //time
        $fetch_time = mockinformation::select()->where('id',$id)->get()[0]->time;
        $array_time = explode(':',$fetch_time);
        if(isset($array_time[1])){
                $count_down = ($array_time[0]*60*60)+($array_time[1]*60) +($array_time[2]);
        }else{
            $count_down = $fetch_time;
        }
        if(mockinformation::findOrFail($id)->type == '1'){
            $url = "random";
        }else{
            $url = "manual";
        }

        return view('frontend.mock-exam',['data'=>$data,'total_question'=>$total_question,'id'=>$id])->with(['count_down'=>$count_down,'url'=>$url,'mark'=>$mark,'lab'=>$lab]);
    }

    function ManualExam($id){

        if(mockinformation::where('id',$id)->where('type','2')->count() >= 4){
            return redirect('q-bank/mock-exam/manual-mock');
        }
        if (mockinformation::findOrFail($id)->time == '0') {
            return redirect('q-bank/manual/exam/result/'.$id);
        }

        $exam_id = mockinformation::findOrFail($id)->exam_id;
        $data = mockquestion::select()->where('exam_id',$exam_id)->simplePaginate(1);
        $mark = mockquestion::select()->where('exam_id',$exam_id)->get();
        $total_question = mockquestion::where('exam_id',$exam_id)->count();
        $lab = ui_team_work::findOrFail(10)->content;
        //time
        $fetch_time = mockinformation::select()->where('id',$id)->get()[0]->time;
        $array_time = explode(':',$fetch_time);
        if(isset($array_time[1])){
                $count_down = ($array_time[0]*60*60)+($array_time[1]*60) +($array_time[2]);
        }else{
            $count_down = $fetch_time;
        }
        if(mockinformation::findOrFail($id)->type == '1'){
            $url = "random";
        }else{
            $url = "manual";
        }

        return view('frontend.mock-exam',['data'=>$data,'total_question'=>$total_question,'id'=>$id])->with(['count_down'=>$count_down,'url'=>$url,'mark'=>$mark,'lab'=>$lab]);
    }

    function FinishExam($user_id,$mock_id){

        $mock = mockinformation::find($mock_id);

        if(Auth::user()->id == $user_id){
            $count = mockinformation::where('user_id', $user_id)->where('type', $mock->type)->count();
            mockinformation::findOrFail($mock_id)->update([
                'time' => '0',
                'status' => "2",
                'position' => $count,
            ]);

            return back();
        }
    }

    function TimerExam($user_id,$mock_id,$time){

        if(Auth::user()->id == $user_id){
            mockinformation::findOrFail($mock_id)->update([
                'time' => $time,
            ]);
        }
    }

    function MockResult($id){

        if (mockinformation::findOrFail($id)->type == '1') {
            if (mockinformation::findOrFail($id)->time != '0') {
                return redirect('q-bank/random/exam/'.$id);
            }
        }elseif (mockinformation::findOrFail($id)->type == '2') {
            if (mockinformation::findOrFail($id)->time != '0') {
                return redirect('q-bank/manual/exam/'.$id);
            }
        }else{
            if (mockinformation::findOrFail($id)->time != '0') {
                return redirect('q-bank/recall-exam/result/'.$id);
            }
        }

        $exam_id = mockinformation::findOrFail($id)->exam_id;
        $data = mockquestion::select()->where('exam_id',$exam_id)->simplePaginate(1);
        $mark = mockquestion::select()->where('exam_id',$exam_id)->get();
        $total_question = mockquestion::where('exam_id',$exam_id)->count();
        $lab = ui_team_work::findOrFail(10)->content;
        $examDetailsInfo = mockinformation::findOrFail($id);
        return view('frontend.mock-exam-result',['data'=>$data,'examDetailsInfo'=>$examDetailsInfo, 'total_question'=>$total_question,'id'=>$id,'mark'=>$mark,'lab'=>$lab]);
    }
}
