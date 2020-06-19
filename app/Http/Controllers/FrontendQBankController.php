<?php

namespace App\Http\Controllers;

use App\categoty;
use App\flag;
use App\mockinformation;
use App\subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendQBankController extends Controller
{
    function Index(){

        return view('frontend.q-bank');
    }

    function RevisionCategory(){

        $data = categoty::orderBy('id', 'ASC')
                        ->paginate(30);

        return view('frontend.revision-category',['data'=>$data]);
    }

    function RevisionSubCategory(){
        $data = categoty::orderBy('id', 'ASC')
                        ->paginate(30);

        return view('frontend.revision-sub-category',['data'=>$data]);
    }

    function FlaggedQuestions(){

        $data = flag::orderBy('id', 'DESC')
                        ->where('user_id',Auth::user()->id)
                        ->paginate(30);

        return view('frontend.flagged-questions',['data'=>$data]);
    }

    function RandomMock(){

        $exists_data = mockinformation::where('user_id',Auth::user()->id)
                            ->where('status','1')
                            ->where('type','1')
                            ->count();


        $continue_data = $expired_data = NULL;

        $continue_data = mockinformation::orderBy('id', 'DESC')
                        ->where('user_id',Auth::user()->id)
                        ->where('status','1')
                        ->where('type','1')
                        ->get();
        $expired_data = mockinformation::orderBy('id', 'DESC')
                            ->where('user_id',Auth::user()->id)
                            ->where('status','2')->where('type','1')
                            ->get();


        return view('frontend.random-mock',['expired_data'=>$expired_data,'continue_data'=>$continue_data,'exists_data'=>$exists_data]);
    }

    function ManualMock(){
        if(Auth::user()->role == 1 || Auth::user()->role == 4){
            //non verified and admin no access
            return back();
        }elseif(Auth::user()->role == 2){
            //trail no access
            return redirect()->back()
                ->with('no_access_permission__', 'You can not access, please upgrade your plan');
        }


        $exists_data = mockinformation::where('user_id',Auth::user()->id)->where('status','1')->where('type','2')->count();
        $continue_data = $expired_data = $cat = NULL;

        $cat = categoty::all();
        $continue_data = mockinformation::orderBy('id', 'DESC')
                        ->where('user_id',Auth::user()->id)
                        ->where('status','1')
                        ->where('type','2')
                        ->get();
        $expired_data = mockinformation::orderBy('id', 'DESC')
                        ->where('user_id',Auth::user()->id)
                        ->where('status','2')
                        ->where('type','2')
                        ->get();


        return view('frontend.manual-mock',['expired_data'=>$expired_data,'continue_data'=>$continue_data,'exists_data'=>$exists_data,'cat'=>$cat]);
    }
}
