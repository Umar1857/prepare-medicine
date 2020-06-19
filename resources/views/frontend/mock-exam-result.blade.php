@extends('frontend.master-frontend')
@section('js-css')
    <script type="text/javascript">
        function FindNext () {
            var str = document.getElementById ("findInput").value;
            if (str == "") {
                alert ("Please enter some text to search!");
                return;
            }
            if (window.find) {        // Firefox, Google Chrome, Safari
                var found = window.find (str);
                if (!found) {
                    alert ("The following text was not found:\n" + str);
                }
            }
            else {
                alert ("Your browser does not support this example!");
            }
        }
    </script>
    <style>
        /* Labels for checked inputs */
        input:checked + label {
            color: #0161C3;
        }
        /* checkbox && radio */
        .form-radio
        {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            position: relative;
            background-color: #fff;
            color: #666;
            height: 30px;
            width: 30px;
            border: 0;
            border-radius: 0;
            cursor: pointer;
            margin-right: 7px;
            outline: none;
        }
        .a::before,
        .b::before,
        .c::before,
        .d::before,
        .e::before{
            position: absolute;
            font: 13px/1 'Open Sans', sans-serif;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
        }
        .a::before{
            content: 'A';
        }
        .b::before{
            content: 'B';
        }
        .c::before{
            content: 'C';
        }
        .d::before{
            content: 'D';
        }
        .e::before{
            content: 'E';
        }


        .success .form-radio:checked,
        .success .form-radio{
            background-color:#63BA52;
            color:#fff;
            border-color:transparent;
        }
        .form-radio{
            border:1px solid #2A306C;
            min-width:30px;
        }
        .form-radio:hover, .form-radio:checked {
            background-color: #2A306C;
            color: #fff;
            border-color: #2A306C;
        }
        label{
            font: 15px/1.7 'Open Sans', sans-serif;
            color: #333;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            cursor: pointer;
        }
        .form-radio:hover + label,
        .form-radio:checked +label,
        .success .form-radio + label{
            font-weight:bold;
            color:#2A306C;
        }
    </style>
    <style>
        body{
            background: #F4F1EC;
        }
        .inline{
            display: inline;
        }
        .right{
            float: right;
        }
        .search-box {
            background: #ffffff;
            width: 28px;
            height: 28px;
            padding: 0px;
            border-radius: 100%;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px 2px !important;
        }
        .comment-wrap{
            width: 100%;
            height: 220px;
            overflow-y: scroll;
        }
        .bg{
            background: #F4F1EC;
        }
        .success{
            background: #C2F7CF;
        }
        .wrong{
            background: #F9C1C6;
        }
        .active-search-box{
            color: #fff;
            -webkit-box-shadow: 0px 0px 10px 2px rgba(0,0,0,0.5);
            -moz-box-shadow: 0px 0px 10px 2px rgba(0,0,0,0.5);
            box-shadow: 0px 0px 10px 2px rgba(0,0,0,0.5);
            background-color:#ffc107;
        }
        .center{
            margin:0 auto;
            margin-top: 15px;
            margin-bottom: 15px;
            /* background: #DBDBDB; */
        }
        .cart-tab{
            margin:2.5%;
        }
        .radius{
            border-radius: 5%;
        }
    </style>
    <style>
        /* chart style */
        .horizontal .progress-bar {
            float: left;
            height: 45px;
            width: 100%;
            padding: 12px 0;
        }

        .horizontal .progress-track {
            position: relative;
            width: 100%;
            height: 30px;
            background: #ebebeb;
        }

        .horizontal .progress-fill {
            position: relative;
            background: #C73F27;
            height: 30px;
            width: 50%;
            color: #777;
            text-align: center;
            font-family: "Lato","Verdana",sans-serif;
            font-size: 12px;
            line-height: 30px;
        }

        .rounded .progress-track,
        .rounded .progress-fill {
            border-radius: 3px;
            box-shadow: inset 0 0 5px rgba(0,0,0,.2);
        }

        .question_section{
            padding: 20px;
        }
        .question_section div p,
        .question_section ~ .card .card-body{
            font-size:16px;
            line-height:normal;

        }
        .question_section div p{
            padding:0 5px;
        }

        .hide_question_status_board{
            display: none;
        }


        /*customize by 'Developer Rijan'*/
        .top_action{
            border-bottom: 1px solid #ddd;
            padding-bottom: 0px;
            margin-bottom: 10px;
            font-weight:600;
            line-height: 28px;
        }
        .btn_info{
            margin: 0px 10px;
            padding: 3px !important;
            border-radius: 50%;
            background-color: #63BA52 !important;
            -webkit-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 1px 2px 0px rgba(0,0,0,0.75);
        }
        .btn_info img{
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .btn_info:hover{
            transition: .3s;
            background: #888;
            -webkit-box-shadow: 0px 0px 10px 3px rgba(0,0,0,.3);
            -moz-box-shadow: 0px 0px 10px 3px rgba(0,0,0,.3);
            box-shadow: 0px 0px 10px 3px rgba(0,0,0,.3);
            background:transparent !important;
        }
        .top_action p{
            margin-right: 5px
        }

        @media screen and (max-width: 483px){
            .btn_info{
                margin:0;
            }
            .top_action{
                display: block !important;
            }
            .top_action .action_1{
                display: inline-block !important;
            }
            .top_action p button{
                width: 100% !important
            }
        }
        @media screen and (max-width: 425px){

            .btn_info{
                width:40px !important;
                height:40px !important;
            }
        }


        /*Customize by 'Developer Rijan'*/
        .answerColor1,
        .answerColor2,
        .answerColor3,
        .answerColor4,
        .answerColor5{
            /*background: #f5f4f4;*/
            padding: 10px 15px !important;
            border-radius: 5px;
            display:flex;
            align-items:center;
        }
        .pagination_list{
            height: auto;
            overflow-y: auto;
        }
        .pagination_list .block_{
            padding-top: 10px;
            padding-bottom: 10px;
            background: #ddd;
        }

        .questions_status_board,
        .area_first__{
            background: #ddd;
            padding: 10px 3px;
        }
        .questions_status_board .heading,
        .heading__n{
            border-bottom: 1px solid #fff;
            font-weight: bold;
        }

        .yes_{
            background-color: forestgreen !important
        }

        .box_head_info h6{
            position: relative;
            font-size: 13px
        }
        .box_head_info .correct_{
            width: 15px;
            height: 10px;
            color: forestgreen;
        }
        .box_head_info .wrong_{
            width: 15px;
            height: 10px;
            color: #C23C24;
        }
        .tatalAnsNumber{
            border: 1px solid #ddd;
            padding: 0px 1px;
            cursor: pointer;
        }
        .no_style{
            padding: 0;
            margin: 0;
            font-size: 11px;
            font-weight: bold;
        }


        .exam_summary{
            background: #ddd;
            padding: 4px 10px;
        }
        .exam_summary p{
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
            border-bottom:1px solid #fff;
            padding-bottom:10px;
        }
        .exam_summary .table tr th,
        .exam_summary .table tr td{
            border:none;
            padding:4px 7px;
        }
    </style>
@endsection
@section('content')
    <br>
    {{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Mock Exam Result</p>
            </div>
        </div>

        <div class="question-wrapper">
            <div class="row">
                @foreach ($data as $item)

                    {{-- Left part of the exam --}}
                    <div class="col-lg-3 col-md-4 col-sm-12" id="pc">
                        <div class="question-bank sticky-top">
                            <div class='area_first__'>
                                <p class="text-center text-uppercase heading__n">QUESTION BANK</p>
                                <div class="center col-12 pagination_list">
                                    <div class="row block_ justify-content-center">
                                        @for ($i = 1; $i <= $total_question; $i++)

                                            @if (isset($_GET['page']))
                                                @if ($i == $_GET['page'])
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($i == '1')
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- question chart -->

                            <div class="center questions_status_board hide_question_status_board">
                                <table width="95%" class="cart-tab">
                                    <p class="text-center heading text-uppercase">Question Status</p>
                                    <div class="container horizontal rounded">
                                        <div class="d-flex justify-content-around box_head_info">
                                            <h6><span class="correct_"><i class="fas fa-square"></i></span> Correct</h6>
                                            <h6><span class="wrong_"><i class="fas fa-square"></i></span> Wrong</h6>
                                        </div>

                                        @php
                                            //get total answers of the questions
                                                $totalAns_ = (App\mockquestion::where('ques_id',$item->ques_id)->count());

                                                //get total answers of the multi options question
                                                if($item->type == 1){
                                                    $totalAns_multi;
                                                    $totalData_ = (App\mockquestion::where('ques_id',$item->ques_id)->get());

                                                    global $str_make_;
                                                    foreach($totalData_ as $val){
                                                        $str_make_ .= $val->user_ans;
                                                    }
                                                    $arr = explode('-', $str_make_);
                                                    $totalAns_multi = count($arr)-1;
                                                }

                                                //store total answers of each option like A,B,C,D,E
                                                $totalA = "";  // A point for 0
                                                $totalB = "";  // B point for 1
                                                $totalC = "";  // C point for 2
                                                $totalD = "";  // D point for 3
                                                $totalE = "";  // E point for 4
                                                // ): Commnent Organized by 'Developer Rijan'
                                        @endphp

                                        <tbody>
                                        <tr>
                                            <td width="10%">A</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 0) yes_ @endif">
                                                            <span class="d-none">
                                                                @if ($item->type == '0')
                                                                    @php
                                                                        //get total answers of each option like A
                                                                        $totalA = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                    ->where('user_ans','0')
                                                                                    ->count());

                                                                    @endphp
                                                                    {{ round(($totalA * 100)/ $totalAns_) }}%

                                                                @else
                                                                    @php
                                                                        //find total ans for each option
                                                                        $static_data_1 = 0;
                                                                        $static_1 = 0;
                                                                        foreach ($totalData_ as $key => $value) {
                                                                            $exploda_data = explode('-',$value->user_ans);
                                                                            if(in_array('0',$exploda_data)){
                                                                                $static_data_1 = $static_data_1+1;
                                                                                $static_1 = $static_1+1;
                                                                            }
                                                                        }
                                                                        echo (round(($static_data_1*100)/$totalAns_multi))."%";
                                                                        $totalA = $static_1;
                                                                    @endphp
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">B</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 1) yes_ @endif">
                                                            <span class="d-none">
                                                                @if ($item->type == '0')
                                                                    @php
                                                                        //get total answers of each option like B
                                                                        $totalB = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                    ->where('user_ans','1')
                                                                                    ->count());

                                                                    @endphp
                                                                    {{ round(($totalB * 100)/ $totalAns_) }}%
                                                                @else
                                                                    @php
                                                                        //find total ans for each option
                                                                        $static_data_2 = 0;
                                                                        $static_2 = 0;
                                                                        foreach ($totalData_ as $key => $value) {
                                                                            $exploda_data = explode('-',$value->user_ans);
                                                                            if(in_array('1',$exploda_data)){
                                                                                $static_data_2 = $static_data_2+1;
                                                                                $static_2 = $static_2+1;
                                                                            }
                                                                        }
                                                                        echo (round(($static_data_2*100)/$totalAns_multi))."%";
                                                                        $totalB = $static_2;
                                                                    @endphp
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">C</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 2) yes_ @endif">
                                                            <span class="d-none">
                                                                @if ($item->type == '0')
                                                                    @php
                                                                        //get total answers of each option like C
                                                                        $totalC = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                    ->where('user_ans','2')
                                                                                    ->count());

                                                                    @endphp
                                                                    {{ round(($totalC * 100)/ $totalAns_) }}%
                                                                @else
                                                                    @php
                                                                        //find total ans for each option C
                                                                        $static_data_3 = 0;
                                                                        $static_3 = 0;
                                                                        foreach ($totalData_ as $key => $value) {
                                                                            $exploda_data = explode('-',$value->user_ans);
                                                                            if(in_array('2',$exploda_data)){
                                                                                $static_data_3 = $static_data_3+1;
                                                                                $static_3 = $static_3+1;
                                                                            }
                                                                        }
                                                                        echo (round(($static_data_3*100)/$totalAns_multi))."%";
                                                                        $totalC = $static_3;
                                                                    @endphp
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">D</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 3) yes_ @endif">
                                                            <span class="d-none">
                                                                @if ($item->type == '0')
                                                                    @php
                                                                        //get total answers of each option like D
                                                                        $totalD = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                    ->where('user_ans','3')
                                                                                    ->count());

                                                                    @endphp
                                                                    {{ round(($totalD * 100)/ $totalAns_) }}%
                                                                @else
                                                                    @php
                                                                        //find total ans for each option D
                                                                        $static_data_4 = 0;
                                                                        $static_4 = 0;
                                                                        foreach ($totalData_ as $key => $value) {
                                                                            $exploda_data = explode('-',$value->user_ans);
                                                                            if(in_array('3',$exploda_data)){
                                                                                $static_data_4 = $static_data_4+1;
                                                                                $static_4 = $static_4+1;
                                                                            }
                                                                        }
                                                                        echo (round(($static_data_4*100)/$totalAns_multi))."%";
                                                                        $totalD = $static_4;
                                                                    @endphp
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">E</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 4) yes_ @endif">
                                                            <span class="d-none">
                                                                @if ($item->type == '0')
                                                                    @php
                                                                        //get total answers of each option like E
                                                                        $totalE = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                    ->where('user_ans','4')
                                                                                    ->count());

                                                                    @endphp
                                                                    {{ round(($totalE * 100)/ $totalAns_) }}%
                                                                @else
                                                                    @php
                                                                        //find total ans for each option E
                                                                        $static_data_5 = 0;
                                                                        $static_5 = 0;
                                                                        foreach ($totalData_ as $key => $value) {
                                                                            $exploda_data = explode('-',$value->user_ans);
                                                                            if(in_array('4',$exploda_data)){
                                                                                $static_data_5 = $static_data_5+1;
                                                                                $static_5 = $static_5+1;
                                                                            }
                                                                        }
                                                                        echo (round(($static_data_5*100)/$totalAns_multi))."%";
                                                                        $totalE = $static_5;
                                                                    @endphp
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <!--developed by 'Developer Rijan'-->
                            <div class='exam_summary'>
                                <p class='text-uppercase'>Exam Summary</p>
                                <table class='table'>
                                    <tbody>
                                    <tr>
                                        <th>Total Question</th>
                                        <td>{{ $total_question }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Answered</th>
                                        @php
                                            $answered = ($examDetailsInfo->wrong_ans +  $examDetailsInfo->right_ans);
                                            $unanswered =  $total_question - $answered;
                                        @endphp
                                        <td>
                                            {{ $answered }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Un-Answered</th>
                                        <td>
                                            {{ $unanswered }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Correct</th>
                                        <td>
                                            {{ $examDetailsInfo->right_ans }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Wrong</th>
                                        <td>
                                            {{ $examDetailsInfo->wrong_ans + $unanswered }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Your Score</th>
                                        <td>
                                            {{ number_format(($examDetailsInfo->right_ans * 100) / $total_question, 2) }}%
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="exam-summary-graph" class="mt-5"></div>
                        </div>
                    </div>

                    {{-- Right part of the exam start from here --}}
                    <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="card question_section">
                            <div class="top_action d-flex justify-content-start">
                                @isset($_GET['page'])
                                    <p class="action_1">Question {{ $_GET['page'] }} of {{ $total_question }}</p>
                                @endisset
                                @if (!empty($item->mocques_ques->question_flag->where('user_id',Auth::user()->id)[0]) )
                                    <a class='dropFlag' href="{{ url('q-bank/drop/flag/'.$item->mocques_ques->question_flag->where('user_id',Auth::user()->id)[0]->id) }}" title="Remove from Flag" style="color:#63BA52;font-size: 18px;"><i class="fas fa-star"></i></a>
                                @else
                                    <a class="addFlag" href="{{ url('q-bank/add/flag/'.$item->mocques_ques->id) }}" style="font-size: 18px;" title="Flag Now"><i class="fas fa-star"></i></a>
                                @endif
                                <p class="action_1" style="margin-left: 5px">QID: {{ $item->search_id }}</p>
                            </div>
                            <div>
                                <p class="asked-question"> {!! $item->question !!}</p>


                                <br>
                                @if ($item->status == '1')
                                    <div class="alert alert-success mt-1" role="alert">
                                        Your Answer Was Correct
                                        <br/>
                                        {{-- Correct Ans of the question start from here // Developed by 'Developer Rijan' --}}
                                        Correct Ans.
                                        @php
                                            $correct_ans = $item->ans; //correct ans of the question
                                            $ex = explode('-', $item->ans); //explode if have multiple ans

                                            foreach ($ex as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- Correct Ans of the question end here--}}

                                        || Your Ans.
                                        {{-- User submitted ans start from here--}}
                                        @php

                                            $userSubmited = $item->user_ans;
                                            $exp = explode('-', $userSubmited); //explode if have multiple ans

                                            foreach ($exp as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- User submitted ans end from here--}}
                                    </div>
                                @elseif($item->status == '0')
                                    <div class="alert alert-danger mt-1" role="alert">
                                        Your Answer Was Wrong
                                        <br/>
                                        {{-- Correct Ans of the question start from here // Developed by 'Developer Rijan' --}}
                                        Correct Ans.
                                        @php
                                            $correct_ans = $item->ans; //correct ans of the question
                                            $ex = explode('-', $item->ans); //explode if have multiple ans

                                            foreach ($ex as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- Correct Ans of the question end here--}}



                                        || Your Ans.
                                        {{-- User submitted ans start from here--}}
                                        @php

                                            $userSubmited_wrong = $item->user_ans;
                                            $exp = explode('-', $userSubmited_wrong); //explode if have multiple ans

                                            foreach ($exp as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- User submitted ans end from here--}}
                                    </div>
                                @else
                                    <div class="alert alert-danger mt-1" role="alert">
                                        Your Answer Was Wrong
                                        <br/>
                                        {{-- Correct Ans of the question start from here // Developed by 'Developer Rijan' --}}
                                        Correct Ans.
                                        @php
                                            $correct_ans = $item->ans; //correct ans of the question
                                            $ex = explode('-', $item->ans); //explode if have multiple ans

                                            foreach ($ex as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- Correct Ans of the question end here--}}



                                        || Your Ans.
                                        {{-- User submitted ans start from here--}}
                                        @php

                                            $userSubmited_wrong = $item->user_ans;
                                            $exp = explode('-', $userSubmited_wrong); //explode if have multiple ans

                                            foreach ($exp as $key => $value) {
                                                if($value === '0'){ echo '<b>A </b>'; }
                                                if($value === '1'){ echo '<b>B </b>'; }
                                                if($value === '2'){ echo '<b>C </b>'; }
                                                if($value === '3'){ echo '<b>D </b>'; }
                                                if($value === '4'){ echo '<b>E </b>'; }
                                            }
                                        @endphp
                                        {{-- User submitted ans end from here--}}
                                    </div>
                                @endif


                            </div>
                            <div>
                                {{-- Single Choice question --}}
                                @if ($item->type == '0')
                                    @foreach ($item->mocques_ans as $key=>$value)
                                        @if ($key == '0')
                                            @if ($key == $item->ans)
                                                <div class="success mb-2 answerColor1 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio a">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                </span>
                                                </div>
                                            @elseif ($key == $item->user_ans)
                                                @if ('0' ==  $item->user_ans)
                                                    <div class="wrong mb-2 answerColor2 pb-2 radius d-flex align-items-center">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio a">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>

                                                        {{--Answer Status Update--}}
                                                        <span class="status_wrapper al-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                </span>
                                                    </div>
                                                @else
                                                    <div class="mb-2 pb-2 answerColor3 radius d-flex align-items-center">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio a">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>

                                                        {{--Answer Status Update--}}
                                                        <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                </span>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="mb-2 pb-2 answerColor4 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio a">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                </span>
                                                </div>
                                            @endif
                                        @elseif($key == '1')
                                            @if ($key == $item->ans)
                                                <div class="success mb-2 answerColor5 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio b">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                </span>
                                                </div>
                                            @elseif ($key == $item->user_ans)
                                                @if (empty($item->user_ans))
                                                    @continue
                                                @endif
                                                <div class="wrong mb-2 answerColor1 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio b">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                </span>
                                                </div>
                                            @else
                                                <div class="mb-2 pb-2 answerColor2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio b">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                </span>
                                                </div>
                                            @endif
                                        @elseif($key == '2')
                                            @if ($key == $item->ans)
                                                <div class="success answerColor3 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio c">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                </span>
                                                </div>
                                            @elseif ($key == $item->user_ans)
                                                @if (empty($item->user_ans))
                                                    @continue
                                                @endif
                                                <div class="wrong answerColor4 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio c">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                </span>
                                                </div>
                                            @else
                                                <div class="mb-2 answerColor5 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio c">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                </span>
                                                </div>
                                            @endif
                                        @elseif($key == '3')
                                            @if ($key == $item->ans)
                                                <div class="success answerColor1 mb-2 pb-2 radius  d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio d">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                </span>
                                                </div>
                                            @elseif ($key == $item->user_ans)
                                                @if (empty($item->user_ans))
                                                    @continue
                                                @endif
                                                <div class="wrong answerColor2 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio d">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                </span>
                                                </div>
                                            @else
                                                <div class="answerColor3 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio d">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                </span>
                                                </div>
                                            @endif
                                        @elseif($key == '4')
                                            @if ($key == $item->ans)
                                                <div class="success answerColor1 mb-2 pb-2 radius  d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio e">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                </span>
                                                </div>
                                            @elseif ($key == $item->user_ans)
                                                @if (empty($item->user_ans))
                                                    @continue
                                                @endif
                                                <div class="wrong answerColor2 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio e">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                </span>
                                                </div>
                                            @else
                                                <div class="answerColor3 mb-2 pb-2 radius d-flex align-items-center">
                                                    <input type="radio" name="answer" value="{{ $key }}" class="form-radio e">
                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                    {{--Answer Status Update--}}
                                                    <span class="status_wrapper ml-auto">
                                                    <p class="inline mb-0" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                            {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                        @else
                                                            {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                        @endif
                                                    </p>
                                                    <p class="inline mb-0" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                </span>
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif

                                {{-- Multiple choice question --}}
                                @if ($item->type == '1')
                                    @foreach ($item->mocques_ans as $key=>$value)
                                        @if ($key == '0')
                                            <div id="muli-ans{{ $key }}" class="answerColor1 mb-2 pb-2 radius">
                                                <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio a">
                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                            </div>
                                        @elseif($key == '1')
                                            <div id="muli-ans{{ $key }}" class="answerColor2 mb-2 pb-2 radius">
                                                <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio b">
                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                            </div>
                                        @elseif($key == '2')
                                            <div id="muli-ans{{ $key }}" class="answerColor3 mb-2 pb-2 radius">
                                                <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio c">
                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                            </div>
                                        @elseif($key == '3')
                                            <div id="muli-ans{{ $key }}" class="answerColor4 mb-2 pb-2 radius">
                                                <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio d">
                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                            </div>
                                        @elseif($key == '4')
                                            <div id="muli-ans{{ $key }}" class="answerColor5 mb-2 pb-2 radius">
                                                <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio e">
                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                    @php
                                        $answers = explode('-',$item->ans);
                                    @endphp
                                    @foreach ($answers as $key => $answer)
                                        <script>
                                            document.querySelector('#muli-ans{{ $answer }}').style.background = "#C2F7CF";
                                        </script>
                                    @endforeach
                                @endif
                                {{-- end --}}

                            </div>
                            <table class="d-flex justify-content-center">
                                <tr>
                                    <td>
                                        <button title="Get Hints" type="button" class="btn btn_info" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <img src="{{ asset('frontend/images/info.png') }}">
                                        </button>
                                    </td>
                                    @if ($data->hasPages())
                                        {{-- Previous Page Link --}}
                                        @if ($data->onFirstPage())
                                            <td>
                                                <button class='btn' style='background:none;border:none'>
                                                    <i class="fa fa-chevron-left disabled" style="font-size:38px; color:#63BA52"></i>
                                                </button>
                                            </td>
                                        @else
                                            <td>
                                                <button class='btn' style='background:none;border:none'>
                                                    <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                </button>
                                            </td>
                                        @endif
                                        {{-- Next Page Link --}}
                                        @if ($data->hasMorePages())
                                            <td>
                                                <button class='btn' style='background:none;border:none'>
                                                    <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                </button>
                                            </td>

                                        @else
                                            <td>
                                                <button class='btn' style='background:none;border:none'>
                                                    <i class="fa fa-chevron-left disabled ml-5" style="font-size:38px;color:#63BA52"></i>
                                                </button>
                                            </td>
                                        @endif
                                    @endif
                                    <td>
                                        <button title="Get Lab Value" type="button" class="btn btn_info" data-toggle="modal" data-target="#exampleModal">
                                            <img src="{{ asset('frontend/images/lab.png') }}">
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- Hints & Lab value --}}
                        <div class="collapse col-12" id="collapseExample">
                            @if (!empty($item->hint) && $item->hint != null)
                                {!! $item->hint !!}
                            @else
                                No hint defined !!
                            @endif
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Lab Values</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="findInput" placeholder="find your information...">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info col-12" onclick="FindNext ();" style="border:none;">Search</button>
                                        </div>
                                        <div id="hint">
                                            {!! $lab !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Hints & Lab value end here --}}


                        {{-- EXPLANATION AND FEEDBACK SECTION START--}}
                        <div class="card my-4">
                            <div class="card-body">
                                {{-- <h3>EXPLANATION</h3> --}}
                                <h3 class="text-uppercase">EXPLANATION</h3>
                                <p class="general-text">{!! $item->explanation !!}</p>
                            </div>
                        </div>

                        <div class='card'>
                            <div class="card-body">
                                <h3 class="text-uppercase">FEEDBACK</h3>
                                {{-- <h3>FEEDBACK</h3> --}}
                                @isset($item->mocques_ques->question_comment[0])

                                    <div class="card">
                                        <div class="card-body" style="background: #E1E0DD;">
                                            <div class="comment-wrap">
                                                @foreach ($item->mocques_ques->question_comment as $value)
                                                    <div class="col-12 bg mb-2 p-4" style="width: 98%;margin-right: 2%;:">
                                                        <h5 style="color: #2F4D36;">
                                                            {{ $value->name }}
                                                            @if ($value->user_id == Auth::user()->id)
                                                                <a href="{{ url('comment/'.$value->id) }}"><i class="fa fa-times text-danger" aria-hidden="true"></i></a>
                                                            @endif
                                                        </h5>
                                                        <p>{{ $value->comment }}</p>
                                                        <p style="text-align:end;">{{ $value->created_at }}</p>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                @endisset
                                {{-- @endif --}}
                                @if (Auth::user()->f_name)
                                    <form action="{{ url('comment/store') }}" method="post" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="question_id" value="{{ $item->ques_id }}">
                                        <textarea name="comment" class="form-control" placeholder="Write Your Feedback !!"></textarea>
                                        <input type="submit" value="SUBMIT" class="btn btn-success mt-3 mb-3 right col-md-3" style="background: #63BA52;">
                                    </form>
                                @endif
                            </div>
                        </div>

                        {{-- EXPLANATION AND FEEDBACK SECTION END--}}
                        {{-- RIGHT PART END HERE--}}

                        {{-- Left part of the exam for mobile view --}}
                        <div class="col-md-3" id="mobile">
                            <br>

                            <div class='area_first__'>
                                <p class="text-center text-uppercase heading__n">QUESTION BANK</p>
                                <div class="center col-12 pagination_list">
                                    <div class="row block_ justify-content-center">

                                        @for ($i = 1; $i <= $total_question; $i++)

                                            @if (isset($_GET['page']))
                                                @if ($i == $_GET['page'])
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($i == '1')
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        @if ( $mark[$i-1]->status == "1")
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/result/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @endif

                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- question chart -->

                            <div class="center questions_status_board hide_question_status_board">
                                <table width="95%" class="cart-tab">
                                    <p class="text-center heading text-uppercase">Question Status</p>
                                    <div class="container horizontal rounded">
                                        <div class="d-flex justify-content-around box_head_info">
                                            <h6><span class="correct_"><i class="fas fa-square"></i></span> Correct</h6>
                                            <h6><span class="wrong_"><i class="fas fa-square"></i></span> Wrong</h6>
                                        </div>

                                        <tbody>
                                        <tr>
                                            <td width="10%">A</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 0) yes_ @endif">
                                                        <span class="d-none">
                                                            @if ($item->type == '0')
                                                                @php
                                                                    //get total answers of each option like A
                                                                    $totalA = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                ->where('user_ans','0')
                                                                                ->count());

                                                                @endphp
                                                                {{ round(($totalA * 100)/ $totalAns_) }}%

                                                            @else
                                                                @php

                                                                    //find total ans for each option
                                                                    $static_data_1 = 0;
                                                                    $static_1 = 0;
                                                                    foreach ($totalData_ as $key => $value) {
                                                                        $exploda_data = explode('-',$value->user_ans);
                                                                        if(in_array('0',$exploda_data)){
                                                                            $static_data_1 = $static_data_1+1;
                                                                            $static_1 = $static_1+1;
                                                                        }
                                                                    }
                                                                    echo (round(($static_data_1*100)/$totalAns_multi))."%";
                                                                    $totalA = $static_1;
                                                                @endphp
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">B</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 1) yes_ @endif">
                                                        <span class="d-none">
                                                            @if ($item->type == '0')
                                                                @php
                                                                    //get total answers of each option like B
                                                                    $totalB = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                ->where('user_ans','1')
                                                                                ->count());

                                                                @endphp
                                                                {{ round(($totalB * 100)/ $totalAns_) }}%
                                                            @else
                                                                @php
                                                                    //find total ans for each option
                                                                    $static_data_2 = 0;
                                                                    $static_2 = 0;
                                                                    foreach ($totalData_ as $key => $value) {
                                                                        $exploda_data = explode('-',$value->user_ans);
                                                                        if(in_array('1',$exploda_data)){
                                                                            $static_data_2 = $static_data_2+1;
                                                                            $static_2 = $static_2+1;
                                                                        }
                                                                    }
                                                                    echo (round(($static_data_2*100)/$totalAns_multi))."%";
                                                                    $totalB = $static_2;
                                                                @endphp
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">C</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 2) yes_ @endif">
                                                        <span class="d-none">
                                                            @if ($item->type == '0')
                                                                @php
                                                                    //get total answers of each option like C
                                                                    $totalC = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                ->where('user_ans','2')
                                                                                ->count());

                                                                @endphp
                                                                {{ round(($totalC * 100)/ $totalAns_) }}%
                                                            @else
                                                                @php
                                                                    //find total ans for each option C
                                                                    $static_data_3 = 0;
                                                                    $static_3 = 0;
                                                                    foreach ($totalData_ as $key => $value) {
                                                                        $exploda_data = explode('-',$value->user_ans);
                                                                        if(in_array('2',$exploda_data)){
                                                                            $static_data_3 = $static_data_3+1;
                                                                            $static_3 = $static_3+1;
                                                                        }
                                                                    }
                                                                    echo (round(($static_data_3*100)/$totalAns_multi))."%";
                                                                    $totalC = $static_3;
                                                                @endphp
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">D</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 3) yes_ @endif">
                                                        <span class="d-none">
                                                            @if ($item->type == '0')
                                                                @php
                                                                    //get total answers of each option like D
                                                                    $totalD = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                ->where('user_ans','3')
                                                                                ->count());

                                                                @endphp
                                                                {{ round(($totalD * 100)/ $totalAns_) }}%
                                                            @else
                                                                @php
                                                                    //find total ans for each option D
                                                                    $static_data_4 = 0;
                                                                    $static_4 = 0;
                                                                    foreach ($totalData_ as $key => $value) {
                                                                        $exploda_data = explode('-',$value->user_ans);
                                                                        if(in_array('3',$exploda_data)){
                                                                            $static_data_4 = $static_data_4+1;
                                                                            $static_4 = $static_4+1;
                                                                        }
                                                                    }
                                                                    echo (round(($static_data_4*100)/$totalAns_multi))."%";
                                                                    $totalD = $static_4;
                                                                @endphp
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="10%">E</td>
                                            <td width="70%">
                                                <div class="horizontal">
                                                    <div class="progress-track">
                                                        <div class="progress-fill @if($item->ans == 4) yes_ @endif">
                                                        <span class="d-none">
                                                            @if ($item->type == '0')
                                                                @php
                                                                    //get total answers of each option like E
                                                                    $totalE = (App\mockquestion::where('ques_id',$item->ques_id)
                                                                                ->where('user_ans','4')
                                                                                ->count());

                                                                @endphp
                                                                {{ round(($totalE * 100)/ $totalAns_) }}%
                                                            @else
                                                                @php
                                                                    //find total ans for each option E
                                                                    $static_data_5 = 0;
                                                                    $static_5 = 0;
                                                                    foreach ($totalData_ as $key => $value) {
                                                                        $exploda_data = explode('-',$value->user_ans);
                                                                        if(in_array('4',$exploda_data)){
                                                                            $static_data_5 = $static_data_5+1;
                                                                            $static_5 = $static_5+1;
                                                                        }
                                                                    }
                                                                    echo (round(($static_data_5*100)/$totalAns_multi))."%";
                                                                    $totalE = $static_5;
                                                                @endphp
                                                            @endif
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="20%" class="d-flex">
                                                <p class="no_style" style="margin: 0px 2px">
                                                    @if ($item->type == '0')
                                                        {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                    @else
                                                        {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                    @endif
                                                </p>
                                                <p class="no_style" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </div>
                                </table>
                            </div>

                            <!--developed by 'Developer Rijan'-->
                            <div class='exam_summary' style='padding-left:15px;margin-top:25px'>
                                <p class='text-uppercase mt-4'>Exam Summary</p>
                                <table class='table'>
                                    <tbody>
                                    <tr>
                                        <th>Total Question</th>
                                        <td>{{ $total_question }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Answered</th>
                                        <td>
                                            {{ ($examDetailsInfo->wrong_ans +  $examDetailsInfo->right_ans) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Correct</th>
                                        <td>
                                            {{ $examDetailsInfo->right_ans }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Total Wrong</th>
                                        <td>
                                            {{ $examDetailsInfo->wrong_ans }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Your Score</th>
                                        <td>
                                            {{ number_format(($examDetailsInfo->right_ans * 100) / $total_question, 2).'%'}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="exam-summary-graph" class="mt-5"></div>
                        </div>
                    </div><!-- .row end here -->
                @endforeach
            </div>
        </div>
    </div>
    <br>
@endsection
@section('js')
    {{-- Circle Chart for verces --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

        // Manual Exam
        google.charts.setOnLoadCallback(Manual);

        function Manual() {

            var data = google.visualization.arrayToDataTable([
                ['Task', ' '],
                ['Correct', {{ $examDetailsInfo->right_ans }}],
                ['Wrong', {{ $total_question - $examDetailsInfo->right_ans  }}],
            ]);

            var options = {
                title: 'Exam Summary Graph',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                backgroundColor: '#ddd',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('exam-summary-graph'));

            chart.draw(data, options);
        }
        // End Manual
    </script>
    <script>
        $(document).ready(function(){
            var value = localStorage.getItem('scrollTo');
            if (value) {
                var offset = $('.pagination_list').offset();
                $('.pagination_list', document.body).animate({
                    scrollTop: $("#"+value).offset().top - offset.top - 30
                }, 1000);
            }
        });

        // chart js
        $('.horizontal .progress-fill span').each(function(){
            var percent = $(this).html();
            $(this).parent().css('width', percent);
            var val_ = $.trim(percent)
            if (val_ != "0%") {
                $(this).css('color', '#fff')
            }
        });


        $('.vertical .progress-fill span').each(function(){
            var percent = $(this).html();
            var pTop = 100 - ( percent.slice(0, percent.length - 1) ) + "%";
            $(this).parent().css({
                'height' : percent,
                'top' : pTop
            });
        });
    </script>
    <script>
        window.addEventListener("resize", responsive);

        function responsive() {
            if(screen.width > 767){
                document.getElementById("mobile").style.display = "none";
                document.getElementById("pc").style.display = "block";
            }else{
                document.getElementById("pc").style.display = "none";
                document.getElementById("mobile").style.display = "block";
            }
        }

        if(screen.width > 767){
            document.getElementById("mobile").style.display = "none";
            document.getElementById("pc").style.display = "block";
        }else{
            document.getElementById("pc").style.display = "none";
            document.getElementById("mobile").style.display = "block";
        }
    </script>
@endsection
