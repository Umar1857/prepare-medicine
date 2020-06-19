<?php

namespace App\Http\Controllers;

use App\question;
use App\revision;
use App\categoty;
use App\mockquestion;
use App\mockinformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendAccountController extends Controller
{
    function Index(){

        return view('frontend.account');
    }

    function Subscription(){

        return view('frontend.subscription');
    }

    function Progress(){

        $user_id = Auth::user()->id;
        $random = mockinformation::select()->where('user_id',$user_id)->where('type',1)->orderBy('position', 'ASC')->get();
        $random_all = mockinformation::select()->where('type',1)->get();
        $random_others = mockinformation::selectRaw('AVG(right_ans) as \'right\', AVG(wrong_ans) as \'wrong\', position')->where('user_id','!=',$user_id)->where('type',1)->groupBy('position')->get()->toArray();

        $manual = mockinformation::select()->where('user_id',Auth::user()->id)->where('type',2)->orderBy('position', 'ASC')->get();
        $manual_all = mockinformation::select()->where('type',2)->get();
        $manual_others = mockinformation::selectRaw('AVG(right_ans) as \'right\', AVG(wrong_ans) as \'wrong\', position')->where('user_id','!=',$user_id)->where('type',2)->groupBy('position')->get()->toArray();

        $recall = revision::select()->where('user_id',Auth::user()->id)->where('type','1')->get();
        $recall_all = revision::select()->where('type','1')->get();
        $recall_others = mockinformation::selectRaw('AVG(right_ans) as \'right\', AVG(wrong_ans) as \'wrong\', position')->where('user_id','!=',$user_id)->where('type',2)->groupBy('position')->get()->toArray();

        //Random Exam Chart
            //user
        $ran_count = null;
        $ran_right = null;
        foreach($random as $key => $value){
            $ran_count += $value->mockinfo_mockques->count();
            $ran_right += $value->right_ans;
        }
            //all
        $ran_count_all = null;
        $ran_right_all = null;
        foreach($random_all as $key => $value){
            $ran_count_all += $value->mockinfo_mockques->count();
            $ran_right_all += $value->right_ans;
        }

        //Manual Exam Chart
            //user
        $manual_count = null;
        $manual_right = null;
        foreach($manual as $key => $value){
            $manual_count += $value->mockinfo_mockques->count();
            $manual_right += $value->right_ans;
        }
            //all
        $manual_count_all = null;
        $manual_right_all = null;
        foreach($manual_all as $key => $value){
            $manual_count_all += $value->mockinfo_mockques->count();
            $manual_right_all += $value->right_ans;
        }

        //Recall Exam Chart
            //user
        $recall_count = revision::select()->where('user_id',Auth::user()->id)->where('type','1')->count();
        $recall_right = revision::select()->where('user_id',Auth::user()->id)->where('type','1')->where('status','1')->count();
            //all
        $recall_count_all = revision::select()->where('type','1')->count();
        $recall_right_all = revision::select()->where('type','1')->where('status','1')->count();

        //Category Exam Chart
            //user
        $category_count = revision::select()->where('user_id',Auth::user()->id)->where('type','0')->count();
        $category_right = revision::select()->where('user_id',Auth::user()->id)->where('type','0')->where('status','1')->count();
            //all
        $category_count_all = revision::select()->where('type','0')->count();
        $category_right_all = revision::select()->where('type','0')->where('status','1')->count();

        $chart_data = [
            'random' => [
                $ran_count,
                $ran_right,
                $ran_count_all,
                $ran_right_all,
            ],
            'manual' =>[
                $manual_count,
                $manual_right,
                $manual_count_all,
                $manual_right_all,
            ],
            'recall' => [
                $recall_count,
                $recall_right,
                $recall_count_all,
                $recall_right_all,
            ],
            'category' => [
                $category_count,
                $category_right,
                $category_count_all,
                $category_right_all,
            ],
        ];
        // print_r($chart_data);
        // die();



        //developed by 'Developer Rijan'
        $categories_perfonamce = NULL;

        $get_all_cat = categoty::orderBy('id', 'ASC')->get();

        foreach($get_all_cat as $cat){
            //current users total revision
            $total_ = revision::where([
                'user_id'=>Auth::user()->id,
                'cat_id'=>$cat->id
            ])->count();

            //current user total correct
            $total_correct = revision::where([
                'user_id'=>Auth::user()->id,
                'cat_id'=>$cat->id,
                'status'=>1//correct ans
            ])->count();

            //current user total wrong
            $total_wrong = revision::where([
                'user_id'=>Auth::user()->id,
                'cat_id'=>$cat->id,
                'status'=>2//wrong ans
            ])->count();

            //all others users except current
            $total_others = revision::where([
                ['user_id', '!=', Auth::user()->id],
                ['cat_id', '=', $cat->id]
            ])->count();

            //total
            $total = revision::where([
                ['cat_id', '=', $cat->id]
            ])->count();

            $my_perform = 0;
            $other_perform = 0;
            if($total > 0 && $total_ > 0){
                $my_perform = round(($total_ * 100) / $total);
                $other_perform = round(($total_others * 100) / $total);
            }

            $arr = [$cat->name, $my_perform, $other_perform, $total_wrong, $total_correct, $total_];
            $categories_perfonamce[] = $arr;

        }


        //calculate overall progress
        $overall_progress_result = $this->overAllProgressCal(
                        $random, $random_all,
                        $manual, $manual_all,
                        $recall, $recall_all,
                        $ran_right, $ran_right_all,
                        $manual_right, $manual_right_all,
                        $recall_right, $recall_right_all,
                        $category_count, $category_right,
                        $category_count_all, $category_right_all
                    );

        //return $overall_progress_result;
        return view('frontend.progress',[
                                            'random'=>$random, 'random_others' => $random_others,
                                            'manual'=>$manual, 'manual_others' => $manual_others,
                                            'recall'=>$recall,'chart_data'=>$chart_data,
                                            'categories_perfonamce'=>$categories_perfonamce,
                                            'over__all'=>$overall_progress_result
                                        ]);
    }


    private function overAllProgressCal($random, $random_all,
                        $manual, $manual_all,
                        $recall, $recall_all,
                        $ran_right, $ran_right_all,
                        $manual_right, $manual_right_all,
                        $recall_right, $recall_right_all,
                        $category_count, $category_right,
                        $category_count_all, $category_right_all){


        //all segments
        $only_user_rand = count($random);
        $only_others_rand = count($random_all) - $only_user_rand;


        $only_user_manual = count($manual);
        $only_others_manual = count($manual_all) - $only_user_manual;


        $only_user_recall = count($recall);
        $only_others_recall = count($recall_all) - $only_user_recall;

        $category_count; //only user category
        $only_others_category = $category_count_all - $category_count; //only others category




        //total right calculate
        $ran_right; //only user rand right
        $ran_right_all; //only others rand right


        $manual_right; //only user manual right
        $manual_right_all; //only others rand right


        $recall_right; //only user recall right
        $recall_right_all_others = $recall_right_all - $recall_right; //only others recall right


        $category_right; //only user category right
        $only_others_cat_right = $category_right_all - $category_right; //only others category right


        //start calculation
        $only_user__total_q = ($only_user_rand +
                                $only_user_manual +
                                $only_user_recall +
                                $category_count
                            );

        $only_others__total_q = ($only_others_rand +
                                $only_others_manual +
                                $only_others_recall +
                                $only_others_category
                            );



        $only_user__total_right = ($ran_right +
                                $manual_right +
                                $recall_right +
                                $category_right
                            );

        $only_others__total_right = ($ran_right_all +
                                $manual_right_all +
                                $recall_right_all_others +
                                $only_others_cat_right
                            );

        $overall_user_progress = 0;
        if ($only_user__total_right > 0 && $only_user__total_q > 0) {
            $overall_user_progress = ($only_user__total_right * 100) / $only_user__total_q;
        }

        $overall_others_progress = 0;
        if ($only_others__total_right > 0 && $only_others__total_q > 0) {
            $overall_others_progress = ($only_others__total_right * 100) / $only_others__total_q;
        }

        $exact_point_user = number_format($overall_user_progress, 2);
        $exact_point_other = number_format($overall_others_progress, 2);
        $data___ = [round($overall_user_progress),round($overall_others_progress), $exact_point_user, $exact_point_other];
        return $data___;
    }



    function AccountReset(){

        return view('frontend.account-reset');
    }

    function PasswordReset(){

        return view('frontend.password-reset');
    }

    function AccountResetAll(){
        if(Auth::user()->role == 4){
            return back()->with('error', 'You are Admin');
        }elseif (Auth::user()->role == 1 || Auth::user()->role == 2) {
            //not verified or trail can not reset
            return back()->with('no_access_permission__', 'You can not reset your account, please upgrade your plan to unlimited reset!');
        }else{
            if(Auth::user()->expeir_date >= date('Y-m-d')){
                if( !empty(mockinformation::select()->where('user_id',Auth::user()->id)->get()[0]) || !empty(revision::select()->where('user_id',Auth::user()->id)->get()[0])){
                    mockquestion::where('user_id',Auth::user()->id)->delete();
                    mockinformation::where('user_id',Auth::user()->id)->delete();
                    revision::where('user_id',Auth::user()->id)->delete();
                }
                return redirect('/');
            }else{
                return back()->with('no_access_permission__', 'Your Plan Expired, Please Upgrade to Unlimited Reset');
            }

        }


    }
    // function AccountResetRandom(){

    //     if( !empty(mockinformation::select()->where('user_id',Auth::user()->id)->where('status',"1")->where('type',"1")->get()[0])){
    //         $exam_id = mockinformation::select()->where('user_id',Auth::user()->id)->where('status',"1")->where('type',"1")->get()[0]->exam_id;
    //         mockquestion::where('exam_id',$exam_id)->delete();
    //         mockinformation::where('exam_id',$exam_id)->delete();
    //     }
    //     return redirect('/');

    // }

    // function AccountResetManual(){

    //     if( !empty(mockinformation::select()->where('user_id',Auth::user()->id)->where('status',"1")->where('type',"2")->get()[0])){
    //         $exam_id = mockinformation::select()->where('user_id',Auth::user()->id)->where('status',"1")->where('type',"2")->get()[0]->exam_id;
    //         mockquestion::where('exam_id',$exam_id)->delete();
    //         mockinformation::where('exam_id',$exam_id)->delete();
    //     }
    //     return redirect('/');

    // }
}
