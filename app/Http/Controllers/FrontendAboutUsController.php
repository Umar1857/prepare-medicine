<?php

namespace App\Http\Controllers;

use App\ui_team_work;
use App\User;
use Illuminate\Http\Request;

class FrontendAboutUsController extends Controller
{
    function Index (){

        $data = ui_team_work::findOrFail(7)->content;
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();
        return view('frontend.about-us',['data'=>$data, 'teachers' => $users]);
    }
}
