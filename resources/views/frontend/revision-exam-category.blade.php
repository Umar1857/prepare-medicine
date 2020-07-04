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
            height: 32px;
            width: 32px;
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
    .wrong .form-radio:checked,
    .wrong .form-radio{
        background-color:#fb5252;
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
            margin-bottom:0;
        }
        .form-radio + label.inline{
            width:100%;
            display:flex;
        }
        .form-radio + label.inline p{
            font-size:16px;
            padding:0 5px;
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
        /* .form-radio:hover + label,
        .form-radio:checked +label,
        .success .form-radio + label{
            font-weight:bold;
            color:#2A306C;
        } */
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
        /* change */
        .search-box {
            background: #ffffff;
            width: 22px;
            height: 22px;
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
            background: #d4edda !important;
        }
        .wrong{
            background: #F9C1C6 !important;
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


        .top_action{
            border-bottom: 1px solid #ddd;
            padding-bottom: 0px;
            margin-bottom: 10px;
            font-weight:600;
            font-size:16px;
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
        @media all and (max-width:1440px){
            .questions-wrapper #pc {
                max-width: 300px;
                flex: 0 0 300px;
            }
        }
        @media all and (max-width:991px){
            .questions-wrapper #pc {
                max-width: 265px;
                flex: 0 0 265px;
            }
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
        background: #C23C24;
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

        .addFlag:hover{
            color: green !important;
        }
        .dropFlag:hover{
            color: white !important;
        }

        .answerColor1,
        .answerColor2,
        .answerColor3,
        .answerColor4,
        .answerColor5{
            background: #f5f4f4;
            padding: 10px 15px !important;
            border-radius: 5px;
            display:flex;
            align-items:center;
        }

        /*Customize by 'Developer Rijan'*/
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
        .hide_question_status_board{
            display: none;
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
    </style>
@endsection
@section('content')
<br>
{{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>{{\App\categoty::find($data[0]->cat_id) ? \App\categoty::find($data[0]->cat_id)->name : ''}} Revision</p>
            </div>
        </div>

    @include('msg.msg')

    @foreach ($data as $item)
    <div class="questions-wrapper">
        <div class="row">

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
                                                @if (!empty($mark[$i-1]->question_revision))

                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @else
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @endif
                                        @else
                                            @if ($i == '1')
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @else
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @endif
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <br>
                        <!-- question chart -->
                        @if (!empty($item->question_revision))
                            @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                @php
                                    //get total answers of the questions
                                    $totalAns_ = $item->question_revision
                                                    ->where('ques_id',$item->id)
                                                    ->count();

                                    //get total answers of the multi options question
                                    if($item->type == 1){
                                        $totalAns_multi;
                                        $totalData_ = App\revision::select()
                                                        ->where('ques_id',$item->id)->get();
                                        global $str_make_;
                                        foreach($totalData_ as $val){
                                            $str_make_ .= $val->ans;
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
                                <div class="center questions_status_board hide_question_status_board">
                                    <table width="95%" class="cart-tab">
                                        <p class="text-center text-uppercase heading">Question Status</p>
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
                                                                <!-- get correct answer -->
                                                                <div class="progress-fill @if($item->ans == 0) yes_ @endif">
                                                                    <span class="d-none">
                                                                        @if ($item->type == '0')
                                                                            @php
                                                                                //get total answers of each option like A
                                                                                $totalA = $item->question_revision
                                                                                            ->where('ques_id',$item->id)
                                                                                            ->where('ans','0')
                                                                                            ->count();
                                                                            @endphp
                                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            @php

                                                                                //find total ans for each option
                                                                                $static_data_1 = 0;
                                                                                $static_1 = 0;
                                                                                foreach ($totalData_ as $key => $value) {
                                                                                    $exploda_data = explode('-',$value->ans);
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
                                                                <div class="progress-fill @if($item->ans == 1) yes_ @endif ">
                                                                    <span class="d-none">
                                                                        @if ($item->type == '0')
                                                                            @php
                                                                                //get total answers of each option like A
                                                                                $totalB = $item->question_revision
                                                                                            ->where('ques_id',$item->id)
                                                                                            ->where('ans','1')
                                                                                            ->count();
                                                                            @endphp

                                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            @php
                                                                                $static_data_2 = 0;
                                                                                $static_2 = 0;
                                                                                foreach ($totalData_ as $key => $value) {
                                                                                    $exploda_data = explode('-',$value->ans);
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
                                                                                //get total answers of each option like A
                                                                                $totalC = $item->question_revision
                                                                                            ->where('ques_id',$item->id)
                                                                                            ->where('ans','2')
                                                                                            ->count();
                                                                            @endphp
                                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            @php

                                                                                $static_data_3 = 0;
                                                                                $static_3 = 0;
                                                                                foreach ($totalData_ as $key => $value) {
                                                                                    $exploda_data = explode('-',$value->ans);
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
                                                                                //get total answers of each option like A
                                                                                $totalD = $item->question_revision
                                                                                            ->where('ques_id',$item->id)
                                                                                            ->where('ans','3')
                                                                                            ->count();
                                                                            @endphp
                                                                            {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            @php

                                                                                $static_data_4 = 0;
                                                                                $static_4 = 0;
                                                                                foreach ($totalData_ as $key => $value) {
                                                                                    $exploda_data = explode('-',$value->ans);
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
                                                                <div class="progress-fill @if($item->ans == 4) yes_ @endif ">
                                                                    <span class="d-none">
                                                                        @if ($item->type == '0')
                                                                            @php
                                                                                //get total answers of each option like A
                                                                                $totalE = $item->question_revision
                                                                                            ->where('ques_id',$item->id)
                                                                                            ->where('ans','4')
                                                                                            ->count();
                                                                            @endphp
                                                                            {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            @php

                                                                                $static_data_5 = 0;
                                                                                $static_5 = 0;
                                                                                foreach ($totalData_ as $key => $value) {
                                                                                    $exploda_data = explode('-',$value->ans);
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
                                                                {{ (round(($static_data_5 * 100)/$totalAns_multi)) }}%
                                                            @endif
                                                        </p>
                                                        <p class="no_style" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </div>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                {{-- Right part of the exam --}}
                <div class="col-md">

                        <div class="card question_section">
                                <div class="top_action d-flex justify-content-start">
                                    @isset($_GET['page'])
                                        <p class="action_1">Question {{ $_GET['page'] }} of {{ $total_question }} </p>
                                    @endisset

                                    @if (!empty($item->question_flag->where('user_id',Auth::user()->id)[0]) )
                                        <a class='dropFlag' href="{{ url('q-bank/drop/flag/'.$item->question_flag->where('user_id',Auth::user()->id)[0]->id) }}" style="color:#63BA52;font-size: 18px;" title="Remove from Flag"><i class="fas fa-star"></i></a>
                                    @else
                                        <a class="='addFlag" href="{{ url('q-bank/add/flag/'.$item->id) }}" style="color:#2C3069 !important;font-size: 18px;" title="Flag Now"><i class="fas fa-star"></i></a>
                                    @endif

                                    <p class="action_1" style="margin-left: 5px">QID: {{ $item->search_id }} </p>
                                </div>

                               <p class="asked-question"> {!! $item->question !!}</p>

                                @if (!empty($item->question_revision))
                                    @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                        @if ($item->ans == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
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

                                                        $userSubmited = $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'];
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

                                                        $userSubmited_wrong = $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'];
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
                                    @endif
                                @endif

                            <br>
                            <!-- qustion answering slot 1 -->
                            <div>
                                    @if (!empty($item->question_revision))
                                        @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                            {{--Answer Single Choice question --}}
                                            @if ($item->type == '0')
                                                @foreach ($item->question_ans as $key=>$value)
                                                    @if ($key == '0')
                                                        @if ($key == $item->ans)
                                                            <div class="success answerColor1 pl-2 mb-2 pb-2 radius d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-2021" class="form-radio a">
                                                                <label for="radio-2021" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @elseif ($key == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
                                                            <div class="wrong mb-2 answerColor2 pl-2 pb-2 radius d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-19" class="form-radio a">
                                                                <label for="radio-19" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                                {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="mb-2 pb-2 answerColor3 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-18" class="form-radio a">
                                                                <label for="radio-18" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @elseif($key == '1')
                                                        @if ($key == $item->ans)
                                                            <div class="success mb-2 answerColor1 pb-2 pl-2 radius d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-17" class="form-radio b">
                                                                <label for="radio-17" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @elseif ($key == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
                                                            <div class="wrong mb-2 answerColor2 pb-2 pl-2 radius d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-16" class="form-radio b">
                                                                <label for="radio-16" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                                {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="mb-2 pb-2 answerColor3 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-15" class="form-radio b">
                                                                <label for="radio-15" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    {{--Answer Status Update--}}
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                                {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @elseif($key == '2')
                                                        @if ($key == $item->ans)
                                                            <div class="success answerColor1 mb-2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-14" class="form-radio c">
                                                                <label for="radio-14" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @elseif ($key == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
                                                            <div class="wrong answerColor2 mb-2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-13" class="form-radio c">
                                                                <label for="radio-13" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="mb-2 answerColor3 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-12" class="form-radio c">
                                                                <label for="radio-12" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @elseif($key == '3')
                                                        @if ($key == $item->ans)
                                                            <div class="success answerColor1 mb-2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-11" class="form-radio d">
                                                                <label for="radio-11" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @elseif ($key == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
                                                            <div class="wrong answerColor2 mb-2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-10" class="form-radio d">
                                                                <label for="radio-10" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="mb-2 answerColor3 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-9" class="form-radio d">
                                                                <label for="radio-9" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @elseif($key == '4')
                                                        @if ($key == $item->ans)
                                                            <div class="success answerColor1 mb-2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-8" class="form-radio e">
                                                                <label for="radio-8" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>
                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @elseif ($key == $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->get()[0]['ans'])
                                                            <div class="wrong mb-2 answerColor2 pb-2 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-7" class="form-radio e">
                                                                <label for="radio-7" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @else
                                                            <div class="mb-2 pb-2 answerColor3 radius pl-2 d-flex align-items-center">
                                                                <input type="radio" name="answer" id="radio-6" class="form-radio e">
                                                                <label for="radio-6" value="{{ $key }}" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p>

                                                                    <span class="status_wrapper ml-auto">
                                                                        <p class="inline" style="margin: 0px 2px">
                                                                            @if ($item->type == '0')
                                                                                {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                            @else
                                                                                {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                                            @endif
                                                                        </p>
                                                                        <p class="inline" title="Total answers of this option">{{ "(".$totalE.")" }}</p>
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif

                                            {{--Answer Multiple choice question --}}
                                            @if ($item->type == '1')
                                                @foreach ($item->question_ans as $key=>$value)
                                                    @if ($key == '0')
                                                        <div class="mb-2 pb-2 answerColor1 radius pl-2 d-flex align-items-center"  id="muli-ans{{ $key }}">
                                                            <input type="checkbox" name="answer[]" id="radio-5" class="form-radio a"><label for="radio-5" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalA * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_1*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalA.")" }}</p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @elseif($key == '1')
                                                        <div class="mb-2 pb-2 answerColor2 radius pl-2 d-flex align-items-center" id="muli-ans{{ $key }}">
                                                            <input type="checkbox" name="answer[]" id="radio-4" class="form-radio b"><label for="radio-4" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_2*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalB.")" }}</p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @elseif($key == '2')
                                                        <div class="mb-2 pb-2 answerColor3 radius pl-2 d-flex align-items-center" id="muli-ans{{ $key }}">
                                                            <input type="checkbox" name="answer[]" id="radio-3" class="form-radio c"><label for="radio-3" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_3*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalC.")" }}</p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @elseif($key == '3')
                                                        <div class="mb-2 pb-2 answerColor4 radius pl-2 d-flex align-items-center" id="muli-ans{{ $key }}">
                                                            <input type="checkbox" name="answer[]" id="radio-2" class="form-radio d"><label for="radio-2" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_4*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalD.")" }}</p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @elseif($key == '4')
                                                        <div class="mb-2 pb-2 answerColor5 radius pl-2 d-flex align-items-center" id="muli-ans{{ $key }}">
                                                            <input type="checkbox" name="answer[]" id="radio-1" class="form-radio e"><label for="radio-1" value="{{ $key }}" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p>

                                                                <span class="status_wrapper ml-auto">
                                                                    <p class="inline" style="margin: 0px 2px">
                                                                        @if ($item->type == '0')
                                                                            {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                        @else
                                                                            {{ (round(($static_data_5*100)/$totalAns_multi)) }}%
                                                                        @endif
                                                                    </p>
                                                                    <p class="inline" title="Total answers of this option">{{ "(".$totalE   .")" }}</p>
                                                                </span>
                                                            </label>
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

                                            @if ($data->hasPages())
                                                <table class="d-flex justify-content-center">
                                                    <tr>
                                                        {{-- Previous Page Link --}}
                                                        @if ($data->onFirstPage())
                                                            <td>
                                                                <button class='btn' style='background:none;border:none'>
                                                                    <i class="fa fa-chevron-left disabled" style="font-size:38px; color:#63BA52"></i>
                                                                </button>
                                                            </td>
                                                        @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                                    </button>
                                                                </td>
                                                        @endif
                                                        {{-- Next Page Link --}}
                                                        @if ($data->hasMorePages())
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                                    </button>

                                                                </td>
                                                        @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <i class="fa fa-chevron-left disabled ml-5" style="font-size:38px;color:#63BA52"></i>
                                                                    </button>
                                                                </td>
                                                        @endif
                                                    </tr>
                                                </table>
                                            @endif

                                        {{-- end --}}

                                        <!-- Answer submit forms -->
                                        @else
                                            {{-- Single Choice question - prepare by specialities --}}
                                            @if ($item->type == '0')
                                                <form action="{{ url($action_single) }}" method="post">
                                                    @if ( $data->hasMorePages() )
                                                        <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                                    @else
                                                        <input type="hidden" name="page" value="0">
                                                    @endif
                                                    @csrf
                                                    <input type="hidden" name="question_id" value="{{ $item->id }}">
                                                    @foreach ($item->question_ans as $key=>$value)
                                                        @if ($key == '0')
                                                            <div class="mb-2 pb-2 radius answerColor1">
                                                                <input type="radio" name="answer" value="{{ $key }}" id="radio-21" class="form-radio a"><label for="radio-21" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}11</p></label>
                                                            </div>
                                                        @elseif($key == '1')
                                                            <div class="mb-2 pb-2 answerColor2 radius">
                                                                <input type="radio" name="answer" value="{{ $key }}" id="radio-22" class="form-radio b"><label for="radio-22" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '2')
                                                            <div class="mb-2 pb-2 answerColor3 radius">
                                                                <input type="radio" name="answer" value="{{ $key }}" id="radio-23" class="form-radio c"><label for="radio-23" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '3')
                                                            <div class="mb-2 pb-2 answerColor4 radius">
                                                                <input type="radio" name="answer" value="{{ $key }}" id="radio-24" class="form-radio d"><label for="radio-24" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '4')
                                                            <div class="mb-2 pb-2 answerColor5 radius">
                                                                <input type="radio" name="answer" value="{{ $key }}" id="radio-2526" class="form-radio e"><label for="radio-2526" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @endif
                                                    @endforeach

                                                    <table class="d-flex justify-content-center">
                                                        <tr>
                                                            <td>
                                                                <button title="Get Hints" type="button" class="btn btn_info" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                    <img src="{{ asset('frontend/images/info.png') }}">
                                                                </button>
                                                            </td>
                                                    <!-- previous page/previous question -->
                                                         @if ($data->hasPages())


                                                                {{-- Previous Page Link --}}
                                                                @if ($data->onFirstPage())
                                                                    <td>
                                                                        <button class="btn" style="background: none;border: none;">
                                                                            <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
                                                                        </button>
                                                                    </td>
                                                                @else
                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                                            </button>
                                                                        </td>
                                                                @endif
                                                         @endif
                                                                {{-- Submit button --}}
                                                                <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px"> </td>

                                                    <!-- next page/next question -->
                                                        @if ($data->hasPages())
                                                                {{-- Next Page Link --}}
                                                                @if ($data->hasMorePages())
                                                                    @if(Auth::user()->role == 2 && $data->currentPage() == 30)
                                                                        <td>{{ 'LIMITED' }}</td>
                                                                    @else
                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                                            </button>
                                                                        </td>
                                                                    @endif

                                                                @else
                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
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
                                                </form>


                                            @endif

                                            {{-- Multiple choice question - Prepare by Specialist --}}
                                            @if ($item->type == '1')
                                                <form action="{{ url($action_multi) }}" method="post">
                                                    @if ( $data->hasMorePages() )
                                                        <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                                    @else
                                                        <input type="hidden" name="page" value="0">
                                                    @endif
                                                    @csrf
                                                    <input type="hidden" name="question_id" value="{{ $item->id }}">
                                                    @foreach ($item->question_ans as $key=>$value)
                                                        @if ($key == '0')
                                                            <div class="mb-2 pb-2 radius answerColor1">
                                                                <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-26" class="form-radio a"><label for="radio-26" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '1')
                                                            <div class="mb-2 answerColor2 pb-2 radius">
                                                                <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-27" class="form-radio b"><label for="radio-27" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '2')
                                                            <div class="mb-2 answerColor3 pb-2 radius">
                                                                <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-28" class="form-radio c"><label for="radio-28" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '3')
                                                            <div class="mb-2 answerColor4 pb-2 radius">
                                                                <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-29" class="form-radio d"><label for="radio-29" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @elseif($key == '4')
                                                            <div class="mb-2 answerColor5 pb-2 radius">
                                                                <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-30" class="form-radio e"><label for="radio-30" class="inline">
                                                                    <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                            </div>
                                                        @endif
                                                    @endforeach

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
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
                                                                            </button>
                                                                        </td>
                                                                @else

                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                                            </button>
                                                                        </td>
                                                                @endif
                                                    @endif
                                                                {{-- Submit button --}}
                                                                <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px"> </td>
                                                    @if ($data->hasPages())
                                                                {{-- Next Page Link --}}
                                                                @if ($data->hasMorePages())
                                                                    @if(Auth::user()->role == 2 && $data->currentPage() == 30)
                                                                        <td>{{ 'LIMITED' }}</td>
                                                                    @else
                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                                            </button>
                                                                        </td>
                                                                    @endif

                                                                @else
                                                                        <td>
                                                                            <button class="btn" style="background: none;border: none;">
                                                                                <i class="fa fa-chevron-left disabled" style="font-size:38px;font-color:#63BA52"></i>
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

                                                </form>
                                            @endif
                                            {{-- end --}}
                                        @endif

                                    @else
                                        {{-- Single Choice question - Recall Exam--}}
                                        @if ($item->type == '0')
                                            <form action="{{ url($action_single) }}" method="post">
                                                @if ( $data->hasMorePages() )
                                                    <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                                @else
                                                    <input type="hidden" name="page" value="0">
                                                @endif
                                                @csrf
                                                <input type="hidden" name="question_id" value="{{ $item->id }}">
                                                @foreach ($item->question_ans as $key=>$value)
                                                    @if ($key == '0')
                                                        <div class="mb-2 pb-2 radius answerColor1">
                                                            <input type="radio" name="answer" value="{{ $key }}" id="radio-31" class="form-radio a"><label for="radio-31" class="inline mb-0">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '1')
                                                        <div class="mb-2 answerColor2 pb-2 radius">
                                                            <input type="radio" name="answer" value="{{ $key }}" id="radio-32" class="form-radio b"><label for="radio-32" class="inline mb-0">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '2')
                                                        <div class="mb-2 answerColor3 pb-2 radius">
                                                            <input type="radio" name="answer" value="{{ $key }}" id="radio-33" class="form-radio c"><label for="radio-33" class="inline mb-0">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '3')
                                                        <div class="mb-2 answerColor4 pb-2 radius">
                                                            <input type="radio" name="answer" value="{{ $key }}" id="radio-34" class="form-radio d"><label for="radio-34" class="inline mb-0">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '4')
                                                        <div class="mb-2 answerColor5 pb-2 radius">
                                                            <input type="radio" name="answer" value="{{ $key }}" id="radio-35" class="form-radio e"><label for="radio-35" class="inline mb-0">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @endif
                                                @endforeach

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
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                @endif
                                                            {{-- Submit button --}}
                                                            <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px;"> </td>
                                                @if ($data->hasPages())
                                                            {{-- Next Page Link --}}
                                                            @if ($data->hasMorePages())
                                                                @if(Auth::user()->role == 2 && $data->currentPage() == 30)
                                                                    <td>{{ 'LIMITED' }}</td>
                                                                    @else
                                                                    <td>
                                                                        <button class="btn" style="background: none;border: none;">
                                                                            <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                                        </button>
                                                                    </td>
                                                                @endif
                                                            @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
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

                                            </form>
                                        @endif
                                        {{-- Multiple choice question - recall exam--}}
                                        @if ($item->type == '1')
                                            <form action="{{ url($action_multi) }}" method="post">
                                                @if ( $data->hasMorePages() )
                                                    <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                                @else
                                                    <input type="hidden" name="page" value="0">
                                                @endif
                                                @csrf
                                                <input type="hidden" name="question_id" value="{{ $item->id }}">
                                                @foreach ($item->question_ans as $key=>$value)
                                                    @if ($key == '0')
                                                        <div class="mb-2 pb-2 radius answerColor1">
                                                            <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-36" class="form-radio a"><label for="radio-36" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '1')
                                                        <div class="mb-2 answerColor2 pb-2 radius">
                                                            <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-37" class="form-radio b"><label for="radio-37" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '2')
                                                        <div class="mb-2 answerColor3 pb-2 radius">
                                                            <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-38" class="form-radio c"><label for="radio-38" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '3')
                                                        <div class="mb-2 answerColor4 pb-2 radius">
                                                            <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-39" class="form-radio d"><label for="radio-39" class="inline">
                                                                <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @elseif($key == '4')
                                                        <div class="mb-2 answerColor5 pb-2 radius">
                                                            <input type="checkbox" name="answer[]" value="{{ $key }}" id="radio-40" class="form-radio e"><label for="radio-40" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p></label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if ($data->hasPages())
                                                    <table class="d-flex justify-content-center">
                                                        <tr>
                                                            {{-- Previous Page Link --}}
                                                            @if ($data->onFirstPage())
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:38px;color:#63BA52"></i></a>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                @endif
                                                            {{-- Submit button --}}
                                                            <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px"> </td>
                                                @if ($data->hasPages())
                                                            {{-- Next Page Link --}}
                                                            @if ($data->hasMorePages())
                                                                @if(Auth::user()->role == 2 && $data->currentPage() == 30)
                                                                    <td>{{ 'LIMITED' }}</td>
                                                                    @else
                                                                    <td>
                                                                        <button class="btn" style="background: none;border: none;">
                                                                            <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:38px;color:#63BA52"></i></a>
                                                                        </button>
                                                                    </td>
                                                                @endif

                                                            @else
                                                                <td>
                                                                    <button class="btn" style="background: none;border: none;">
                                                                        <i class="fa fa-chevron-left disabled" style="font-size:38px;color:#63BA52"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </table>
                                                @endif
                                            </form>
                                        @endif
                                        {{-- end --}}
                                    @endif
                            </div>
                                                    </div>


                        {{-- show Hitns --}}
                        <div class="collapse col-12" id="collapseExample">
                            @if (!empty($item->hint) && $item->hint != null)
                                {!! $item->hint !!}
                            @else
                                No hints defined !!
                            @endif
                        </div>

                        {{-- Lab Value Modal --}}
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
                                            <input type="text" class="form-control" id="findInput" placeholder="Find your information...">
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
                        </div> {{-- Lab Value Modal end here--}}


                        {{-- EXPLANATION AND FEEDBACK SECTION START--}}
                        <div class="row mt-4">
                        <div class='col-12 mb-4'>
                            @if (!empty($item->question_revision))
                                @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="text-uppercase">EXPLANATION</h3>
                                            {{-- <h3>EXPLANATION</h3> --}}
                                             <p class="general-text">{!! $item->explanation !!}</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                       </div>

                        <div class='col-12 mb-4'>
                            @if (!empty($item->question_revision) && !empty($files))
                                @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                    <div class="card" style="background-color: #F4F1EC !important; border:none">
                                        <div class="card-body">
                                            <p class="text-uppercase" style="margin-left: -15px;font-weight:bold;font-size:16px">EXPLANATION FILES</p>
                                            @foreach($files as $file)
                                                @if(in_array($file->type, array('pdf', 'jpeg', 'jpg', 'png')))
                                                    <div><a href="{{route('view_file', $file->id)}}" target="_blank">{{$file->name}}</a></div>
                                                @elseif($file->type === 'mp4')
                                                    {{--<video width="320" height="240" controls>
                                                        <source src="{{URL::asset("/storage/app/public/questions/".$item->id.'/'.$file->name)}}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>--}}

                                                    {!! $file->path !!}
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                       <div class='col-12 mb-4'>
                           {{-- @if ($value->comment) --}}
                            @if (!empty($item->question_revision))
                                @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                                <div class="card">
                                        <div class="card-body">
                                    <h3 class="text-uppercase">FEEDBACK</h3>
                                    {{-- <h3>FEEDBACK</h3> --}}
                                    @isset($item->question_comment[0])
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="comment-wrap">
                                                    @foreach ($item->question_comment as $value)
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
                                            <input type="hidden" name="question_id" value="{{ $item->id }}">
                                            <textarea name="comment" class="form-control" placeholder="Write Your Feedback !!"></textarea>
                                            <input type="submit" value="SUBMIT" class="btn btn-success mt-3 mb-3 right col-md-3" style="background: #63BA52;">
                                        </form>
                                    @endif
                                                    </div>
                                                    </div>
                                @endif
                            @endif
                       </div>  {{-- EXPLANATION AND FEEDBACK SECTION END--}}
                        </div>
                </div> 
                {{-- Left part of the exam --}}
                <div class="col-md-3" id="mobile">
                    <div class="area_first__">
                        <p class="text-center text-uppercase heading__n">QUESTION BANK</p>
                        <div class="center col-12 pagination_list">
                                    <div class="row block_ justify-content-center">
                                    @for ($i = 1; $i <= $total_question; $i++)

                                        @if (isset($_GET['page']))
                                            @if ($i == $_GET['page'])
                                                @if (!empty($mark[$i-1]->question_revision))

                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif


                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @else
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @endif
                                        @else
                                            @if ($i == '1')
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @else
                                                @if (!empty($mark[$i-1]->question_revision))
                                                    @if ( !empty($mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()) )
                                                        @if ( array_values(array_filter( $mark[$i-1]->question_revisions->where('user_id',Auth::user()->id)->toArray()))[0]['status'] == "1")
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#81DB97"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @else
                                                            <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no" style="background:#fb5252; color:#fff"><span id="{{$i}}">{{ $i }}</span></a>
                                                        @endif
                                                    @else
                                                        <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    <a href="{{ url($path.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                @endif
                                            @endif
                                        @endif

                                    @endfor
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- question chart -->
                    @if (!empty($item->question_revision))
                        @if ( $item->question_revision->where('user_id',Auth::user()->id)->where('ques_id',$item->id)->count() == "1" )
                            <div class="center questions_status_board">
                                <table width="95%" class="cart-tab">
                                    <p class="text-center text-uppercase heading">Question Status</p>
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
                                                            <!-- get correct answer -->
                                                            <div class="progress-fill @if($item->ans == 0) yes_ @endif">
                                                                <span class="d-none">
                                                                    @if ($item->type == '0')
                                                                        @php
                                                                            //get total answers of each option like A
                                                                            $totalA = $item->question_revision
                                                                                        ->where('ques_id',$item->id)
                                                                                        ->where('ans','0')
                                                                                        ->count();
                                                                        @endphp

                                                                        {{ round(($totalA * 100)/ $totalAns_ ) }}%



                                                                    @else
                                                                        @php

                                                                            //find total ans for each option
                                                                            $static_data_1 = 0;
                                                                            $static_1 = 0;
                                                                            foreach ($totalData_ as $key => $value) {
                                                                                $exploda_data = explode('-',$value->ans);
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
                                                            <div class="progress-fill @if($item->ans == 1) yes_ @endif ">
                                                                <span class="d-none">
                                                                    @if ($item->type == '0')
                                                                        @php
                                                                            //get total answers of each option like A
                                                                            $totalB = $item->question_revision
                                                                                        ->where('ques_id',$item->id)
                                                                                        ->where('ans','1')
                                                                                        ->count();
                                                                        @endphp

                                                                        {{ round(($totalB * 100)/ $totalAns_ ) }}%
                                                                    @else
                                                                        @php
                                                                            $static_data_2 = 0;
                                                                            $static_2 = 0;
                                                                            foreach ($totalData_ as $key => $value) {
                                                                                $exploda_data = explode('-',$value->ans);
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
                                                                            //get total answers of each option like A
                                                                            $totalC = $item->question_revision
                                                                                        ->where('ques_id',$item->id)
                                                                                        ->where('ans','2')
                                                                                        ->count();
                                                                        @endphp
                                                                        {{ round(($totalC * 100)/ $totalAns_ ) }}%
                                                                    @else
                                                                        @php

                                                                            $static_data_3 = 0;
                                                                            $static_3 = 0;
                                                                            foreach ($totalData_ as $key => $value) {
                                                                                $exploda_data = explode('-',$value->ans);
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
                                                                            //get total answers of each option like A
                                                                            $totalD = $item->question_revision
                                                                                        ->where('ques_id',$item->id)
                                                                                        ->where('ans','3')
                                                                                        ->count();
                                                                        @endphp
                                                                        {{ round(($totalD * 100)/ $totalAns_ ) }}%
                                                                    @else
                                                                        @php

                                                                            $static_data_4 = 0;
                                                                            $static_4 = 0;
                                                                            foreach ($totalData_ as $key => $value) {
                                                                                $exploda_data = explode('-',$value->ans);
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
                                                            <div class="progress-fill @if($item->ans == 4) yes_ @endif ">
                                                                <span class="d-none">
                                                                    @if ($item->type == '0')
                                                                        @php
                                                                            //get total answers of each option like A
                                                                            $totalE = $item->question_revision
                                                                                        ->where('ques_id',$item->id)
                                                                                        ->where('ans','4')
                                                                                        ->count();
                                                                        @endphp
                                                                        {{ round(($totalE * 100)/ $totalAns_ ) }}%
                                                                    @else
                                                                        @php

                                                                            $static_data_5 = 0;
                                                                            $static_5 = 0;
                                                                            foreach ($totalData_ as $key => $value) {
                                                                                $exploda_data = explode('-',$value->ans);
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
                        @endif
                    @endif
                </div>
        </div>
    </div>

    @endforeach
 </div>

<br>
@endsection

@section('js')
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

