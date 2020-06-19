<?php

namespace App\Http\Controllers;

use App\comment;
use App\question;
use App\categoty;
use App\recallmodel;
use App\ui_team_work;
use App\user_question;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Collection;

class RevisionController extends Controller
{

    function RevisionCategory($id){
        $data = $mark = $total_question = NULL;


        $lab = ui_team_work::findOrFail(10)->content;
        $path = "q-bank/revision-category/question/";
        $action_single = "revision/compare/single" ;
        $action_multi  = "revision/compare/multi" ;

        if(Auth::user()->role == 1 || Auth::user()->role == 4){
            //no access non verified users or admin
            return back();
        }elseif (Auth::user()->role == 2) {
            //trial - questions from only first categories limited 20
            $cat_data = categoty::orderBy('id', 'ASC')->first();

            if($cat_data){
                $data = question::select()->where('cat_id',$cat_data->id)
                        ->where('status', '0')
                        ->orderBy('id', 'ASC')
                        ->take(20)
                        ->simplePaginate(1);
                $mark = question::select()->where('cat_id',$cat_data->id)
                                ->where('status', '0')
                                ->orderBy('id', 'ASC')
                                ->take(20)->get();
                $counter = question::select()->where('cat_id',$cat_data->id)
                                    ->where('status', '0')
                                    ->orderBy('id', 'ASC')
                                    ->count();

                if ($counter > 20) {
                    $total_question = 20;
                }else{
                    $total_question = $counter;
                }
            }else{
                return back()
                        ->withError('No Specialities Found');
            }
        }elseif(Auth::user()->role == 3 || Auth::user()->role == 5 || Auth::user()->role == 6) {
            //refugees, basic, standard

            //get total questions
            $cat_data = categoty::orderBy('id', 'ASC')->get();
            $cat_idList = [];
            if(!$cat_data->isEmpty()){
                foreach($cat_data as $data_cat){
                    $cat_idList[] = $data_cat->id;
                }
            }
            $totalQuestion = question::whereIn('cat_id',$cat_idList)->count();
            //return $totalQuestion;
            $number_of_q = round((question::where('cat_id',$id)->count() * 2000) / $totalQuestion);
            //return question::where('cat_id',$id)->count();

            $data = question::where('cat_id',$id)
                        ->where('status','0')
                        ->orderBy('id','ASC')
                        ->take($number_of_q)
                        ->simplePaginate(1);
            $mark = question::where('cat_id',$id)
                        ->where('status','0')
                        ->orderBy('id','ASC')
                        ->take($number_of_q)
                        ->get();
            $counter = question::where('cat_id',$id)
                        ->where('status','0')->count();
            /*
            $data__list = [];
            foreach($cat_data as $data_cat){
               $number_of_q = round((question::where('cat_id',$data_cat->id)->count() * 2000) / $totalQuestion);
               $data__list[] = question::select()->where('cat_id',$data_cat->id)
                                        ->where('status', 0)
                                        ->orderBy('id', 'ASC')
                                        ->limit($number_of_q)
                                        ->get();
            }

            //make multi array to single array
            $newArray = [];
            foreach($data__list as $array) {
             foreach($array as $v) {
              $newArray[] = $v;
             }
            }

            //pagination from 'AppServiceProvider'
            $data = (new Collection($newArray))->paginate_build_by_developer_rijan(1);
            $mark = collect($newArray);//make object
            $counter = count($newArray);
            */

            if ($counter > $number_of_q) {
                $total_question = $number_of_q;
            }else{
                $total_question = $counter;
            }

        }else{

            //advanced and professional unlimited
            $data = question::select()->where('cat_id',$id)
                        ->where('status','0')
                        ->simplePaginate(1);
            $mark = question::select()->where('cat_id',$id)
                        ->where('status','0')->get();
            $total_question = question::where('cat_id',$id)
                        ->where('status','0')->count();
        }

        $files = $data[0]->assets()->get();

        return view('frontend.revision-exam-category',[
            'data'=>$data,'total_question'=>$total_question,'id'=>$id,'lab'=>$lab,
            'mark'=>$mark,'path'=>$path,'action_single'=>$action_single,
            'action_multi'=>$action_multi, 'files' => $files]);
    }


    function UserCategory($id){
        $lab = ui_team_work::findOrFail(10)->content;

        $data = $mark = $total_question = NULL;
        if (Auth::user()->role == 1 || Auth::user()->role == 4) {
            //no access for non verified or admin
            return back();
        }else{
            $data = user_question::orderBy('id', 'ASC')
                    ->where('cat_id',$id)
                    ->simplePaginate(1);
            $mark = user_question::orderBy('id', 'DESC')
                    ->where('cat_id',$id)
                    ->get();
            $total_question = user_question::where('cat_id',$id)
                                ->count();
        }


        $path = "q-bank/user-category/question/";
        $action_single = "user-revision/compare/single" ;
        $action_multi  = "user-revision/compare/multi" ;

        return view('frontend.revision-exam-category',['data'=>$data,'total_question'=>$total_question,'id'=>$id,'lab'=>$lab,'mark'=>$mark,'path'=>$path,'action_single'=>$action_single,'action_multi'=>$action_multi]);
    }

    function ReExam($id){

        $data = NULL;
        $mark = NULL;
        $total_question = NULL;

        $lab = ui_team_work::findOrFail(10)->content;
        $path = "q-bank/recall-exam/";
        $action_single = "revision/recall/compare/single" ;
        $action_multi  = "revision/recall/compare/multi" ;

        if(Auth::user()->role == 1 || Auth::user()->role == 4){
            //no access non verified users or admin
            return back();
        }elseif (Auth::user()->role == 2) {
            //trial - questions limited
            $recall_data__ = recallmodel::orderBy('id', 'ASC')->first();


            if($recall_data__){
                $data = question::where('status', $recall_data__->id)
                        ->orderBy('id', 'ASC')
                        ->take(20)
                        ->simplePaginate(1);

                $mark = question::where('status',$recall_data__->id)
                                ->orderBy('id', 'ASC')
                                ->take(20)->get();


                $counter = question::where('status',$recall_data__->id)
                            ->orderBy('id', 'ASC')
                                ->count();

                if ($counter > 20) {
                    $total_question = 20;
                }else{
                    $total_question = $counter;
                }
            }else{
                return back();
            }


        }elseif(Auth::user()->role == 3 || Auth::user()->role == 5) {
            //refugees, basic
            return redirect()->back()
                ->with('no_access_permission__', 'You can not access, please upgrade your plan');
        }else{
            //standard, advanced and professional unlimited
            $data = question::select()->where('status',$id)
                            ->simplePaginate(1);
            $mark = question::select()->where('status',$id)
                            ->get();

           $total_question = question::where('status',$id)->count();
        }

        return view('frontend.revision-exam-category',['data'=>$data,'total_question'=>$total_question,'id'=>$id,'lab'=>$lab,'mark'=>$mark,'path'=>$path,'action_single'=>$action_single,'action_multi'=>$action_multi]);
    }
}
