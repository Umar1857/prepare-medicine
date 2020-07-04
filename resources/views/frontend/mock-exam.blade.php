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


        /*customize by 'Developer Rijan'*/
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




        /*Customize by 'Developer Rijan'*/
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


        /*elasped time*/
        .time_for_destop,
        .time_for_mobile{
            background: #2A306C;
            border: 1px solid #fff;
            padding: 10px;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
            min-height:50px;
            color: #fff
        }

        .one_minute_time_for_destop,
        .one_minute_time_for_mobile{
            background: #ff1313;
            border: 1px solid #fff;
            padding: 10px;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
            min-height:50px;
            color: #fff
        }
        .time2_for_destop,
        .time2_for_mobile{
            background: green;
            border: 1px solid #fff;
            padding: 10px;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
        }
        .time_for_destop #time,
        .time_for_mobile #time_m,
        .one_minute_time_for_destop #one_minute_time,
        .one_minute_time_for_mobile #one_minute_time
        {
            color: #fff
        }
        #per_question_time, #total_exam_time {
            font-size: 12px;
            margin-right: 30px;
        }

        .submited{
            background: #2A306C;
            color: #fff;
        }
        .question_section {
            padding: 20px;
        }
    </style>
@endsection
@section('content')
    <br>
    {{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Mock Exam</p>
            </div>
        </div>
        <div class="questions-wrapper">
            <div class="row">

                @foreach ($data as $item)
                    {{-- Left part of the exam --}}
                    <div class="col-lg-3 col-md-4 col-sm-12" id="pc">
                        <div class="question-bank sticky-top">
                            <div class="col-md-12 time_for_destop">
                                <span id="total_exam_time">Total Exam Time: </span>
                                <span class="text-center" id="time"></span>
                            </div>

                            <div class="col-md-12 one_minute_time_for_destop">
                                <span id="per_question_time">Per Question Time: </span>
                                <span class="text-center" id="one_minute_time"></span>
                            </div>

                            {{--
                            <div>
                                <!--total questions & left questions-->
                                <p>Total Questions: {{ $total_question }}</p>
                                <p>You have attend: {{ $total_question }}</p>

                            </div>
                            --}}

                            <div class="area_first__">
                                <p class="text-center text-uppercase heading__n">QUESTION BANK</p>
                                <div class="center col-12 pagination_list">
                                    <div class="row block_ justify-content-center">
                                        @for ($i = 1; $i <= $total_question; $i++)
                                            @if (isset($_GET['page']))
                                                @if ($i == $_GET['page'])
                                                    @if (!empty($mark[$i-1]->status))
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="submited search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="submited search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @else
                                                @if ($i == '1')
                                                    @if (!empty($mark[$i-1]->status))
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="submited search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if (!empty($mark[$i-1]->status))
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="submited search-box ml-1 mb-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box ml-1 mb-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Right part of the exam --}}
                    <div class="col-md">

                        <div class="card question_section">
                            <div class="top_action d-flex justify-content-start">
                                @isset($_GET['page'])
                                    <p class="action_1">Question {{ $_GET['page'] }} of {{ $total_question }}</p>
                                @endisset
                                @if (!empty($item->mocques_ques->question_flag->where('user_id',Auth::user()->id)[0]) )
                                    <a title="Remove from Flag" class="dropFlag" href="{{ url('q-bank/drop/flag/'.$item->mocques_ques->question_flag->where('user_id',Auth::user()->id)[0]->id) }}" style="color:#63BA52;font-size: 18px;"><i class="fas fa-star"></i></a>
                                @else
                                    <a title="Flag Now" class="addFlag" href="{{ url('q-bank/add/flag/'.$item->mocques_ques->id) }}" style="font-size: 18px;"><i class="fas fa-star"></i></a>
                                @endif
                                <p class="action_1" style="margin-left: 5px">QID: {{ $item->search_id }}</p>
                            </div>
                            <p class="asked-question"> {!! $item->question !!}</p>
                            <br>
                            <div>
                                @if ( empty($item->status) )
                                    {{-- Single Choice question --}}
                                    @if ($item->type == '0')
                                        <form action="{{ url('mock/compare/single') }}" method="post">
                                            @if ( $data->hasMorePages() )
                                                <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                            @else
                                                <input type="hidden" name="page" value="0">
                                            @endif
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $item->exam_id }}">
                                            <input type="hidden" name="question_id" value="{{ $item->id }}">
                                            <input type="hidden" name="input_time" id="input_time" >
                                            @foreach ($item->mocques_ans as $key=>$value)
                                                @if ($key == '0')
                                                    <div class="mb-2 pb-2 radius answerColor1">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio a" id="radio-10"><label for="radio-10" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '1')
                                                    <div class="mb-2 answerColor2 pb-2 radius">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio b" id="radio-11"><label for="radio-11" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '2')
                                                    <div class="mb-2 answerColor3 pb-2 radius">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio c" id="radio-12"><label for="radio-12" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '3')
                                                    <div class="mb-2 answerColor4 pb-2 radius">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio d" id="radio-13"><label for="radio-13" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '4')
                                                    <div class="mb-2 answerColor5 pb-2 radius">
                                                        <input type="radio" name="answer" value="{{ $key }}" class="form-radio e" id="radio-14"><label for="radio-14" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
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
                                                            <td> <i class="fa fa-chevron-left disabled" style="font-size:40px"></i> </td>
                                                        @else
                                                            <td> <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:40px;color:#63BA52"></i></a> </td>
                                                        @endif
                                                        {{-- Submit button --}}
                                                        <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px"> </td>
                                                        {{-- Next Page Link --}}
                                                        @if ($data->hasMorePages())
                                                            <td> <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:40px;color:#63BA52"></i></a> </td>
                                                        @else
                                                            <td> <i class="fa fa-chevron-left disabled" style="font-size:40px"></i> </td>
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

                                    {{-- Multiple choice question --}}
                                    @if ($item->type == '1')
                                        <form action="{{ url('mock/compare/multi') }}" method="post">
                                            @if ( $data->hasMorePages() )
                                                <input type="hidden" name="page" value="{{ $data->nextPageUrl() }}">
                                            @else
                                                <input type="hidden" name="page" value="0">
                                            @endif
                                            @csrf
                                            <input type="hidden" name="exam_id" value="{{ $item->exam_id }}">
                                            <input type="hidden" name="question_id" value="{{ $item->id }}">
                                            <input type="hidden" name="input_time" id="input_time">
                                            @foreach ($item->mocques_ans as $key=>$value)
                                                @if ($key == '0')
                                                    <div class="mb-2 pb-2 radius answerColor1">
                                                        <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio a" id="radio-15"><label for="radio-15" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '1')
                                                    <div class="mb-2 answerColor2 pb-2 radius">
                                                        <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio b" id="radio-16"><label for="radio-16" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '2')
                                                    <div class="mb-2 answerColor3 pb-2 radius">
                                                        <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio c" id="radio-17"><label for="radio-17" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '3')
                                                    <div class="mb-2 answerColor4 pb-2 radius">
                                                        <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio d" id="radio-18"><label for="radio-18" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @elseif($key == '4')
                                                    <div class="mb-2 answerColor5 pb-2 radius">
                                                        <input type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio e" id="radio-19"><label for="radio-19" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
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
                                                            <td> <i class="fa fa-chevron-left disabled" style="font-size:36px"></i> </td>
                                                        @else
                                                            <td> <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                        @endif
                                                        {{-- Submit button --}}
                                                        <td> <input type="submit" value="SUBMIT" class="btn btn-primary ml-4 mr-4" style="background: #0161C3;border-radius:3px"> </td>
                                                        {{-- Next Page Link --}}
                                                        @if ($data->hasMorePages())
                                                            <td> <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                        @else
                                                            <td> <i class="fa fa-chevron-left disabled" style="font-size:36px"></i> </td>
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
                                @else
                                    {{-- Single Choice question --}}
                                    <input type="hidden" id="input_time">
                                    @if ($item->type == '0')
                                        @foreach ($item->mocques_ans as $key=>$value)
                                            @if ($key == '0')
                                                @if ($key == $item->user_ans)
                                                    <div class="mb-2 pb-2 radius answerColor1">
                                                        <input checked disabled type="radio" name="answer" value="{{ $key }}" class="form-radio a" id="radio-1"><label for="radio-1" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @else
                                                    <div class="mb-2 answerColor2 pb-2 radius">
                                                        <input disabled type="radio" name="answer" value="{{ $key }}" class="form-radio a" id="radio-11"><label for="radio-11" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @endif
                                            @elseif($key == '1')
                                                @if ($key == $item->user_ans)
                                                    <div class="mb-2 answerColor3 pb-2 radius">
                                                        <input checked disabled type="radio" name="answer" value="{{ $key }}" class="form-radio b" id="radio-12"><label for="radio-12" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @else
                                                    <div class="mb-2 answerColor4 pb-2 radius">
                                                        <input disabled type="radio" name="answer" value="{{ $key }}" class="form-radio b" id="radio-13"><label for="radio-13" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @endif
                                            @elseif($key == '2')
                                                @if ($key == $item->user_ans)
                                                    <div class="mb-2 pb-2 radius answerColor1">
                                                        <input checked disabled type="radio" name="answer" value="{{ $key }}" class="form-radio c" id="radio-14"><label for="radio-14" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @else
                                                    <div class="mb-2 pb-2 answerColor2 radius">
                                                        <input disabled type="radio" name="answer" value="{{ $key }}" class="form-radio c" id="radio-15"><label for="radio-15" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @endif
                                            @elseif($key == '3')
                                                @if ($key == $item->user_ans)
                                                    <div class="mb-2 answerColor3 pb-2 radius">
                                                        <input checked disabled type="radio" name="answer" value="{{ $key }}" class="form-radio d" id="radio-16"><label for="radio-16" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @else
                                                    <div class="mb-2 answerColor4 pb-2 radius">
                                                        <input disabled type="radio" name="answer" value="{{ $key }}" class="form-radio d" id="radio-17"><label for="radio-17" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @endif
                                            @elseif($key == '4')
                                                @if ($key == $item->user_ans)
                                                    <div class="mb-2 answerColor5 pb-2 radius">
                                                        <input checked disabled type="radio" name="answer" value="{{ $key }}" class="form-radio e" id="radio-18"><label for="radio-18" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @else
                                                    <div class="mb-2 pb-2 radius answerColor1">
                                                        <input disabled type="radio" name="answer" value="{{ $key }}" class="form-radio e" id="radio-19"><label for="radio-19" class="inline">
                                                            <p class="inline mb-0">{{ $value->ans }}</p>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if ($data->hasPages())
                                            <table class="d-flex justify-content-center">
                                                <tr>
                                                    {{-- Previous Page Link --}}
                                                    @if ($data->onFirstPage())
                                                        <td> <i class="fa fa-chevron-left disabled" style="font-size:36px"></i> </td>
                                                    @else
                                                        <td> <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                    @endif
                                                    {{-- Next Page Link --}}
                                                    @if ($data->hasMorePages())
                                                        <td> <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                    @else
                                                        <td> <i class="fa fa-chevron-left disabled ml-5" style="font-size:36px"></i> </td>
                                                    @endif
                                                </tr>
                                            </table>
                                        @endif
                                    @endif

                                    {{-- Multiple choice question --}}
                                    @if ($item->type == '1')
                                        @foreach ($item->mocques_ans as $key=>$value)
                                            @if ($key == '0')
                                                <div class="mb-2 pb-2 radius answerColor1">
                                                    <input disabled id="muli-ans{{ $key }}" type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio a"><label for="muli-ans{{ $key }}" class="inline">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>
                                                </div>
                                            @elseif($key == '1')
                                                <div class="mb-2 answerColor2 pb-2 radius">
                                                    <input disabled id="muli-ans{{ $key }}" type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio b"><label for="muli-ans{{ $key }}" class="inline">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>
                                                </div>
                                            @elseif($key == '2')
                                                <div class="mb-2 answerColor3 pb-2 radius">
                                                    <input disabled id="muli-ans{{ $key }}" type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio c"><label for="muli-ans{{ $key }}" class="inline">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>
                                                </div>
                                            @elseif($key == '3')
                                                <div class="mb-2 answerColor4 pb-2 radius">
                                                    <input disabled id="muli-ans{{ $key }}" type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio d"><label for="muli-ans{{ $key }}" class="inline">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>
                                                </div>
                                            @elseif($key == '4')
                                                <div class="mb-2 answerColor5 pb-2 radius">
                                                    <input disabled id="muli-ans{{ $key }}" type="checkbox" name="answer[]" value="{{ $key }}" class="form-radio e"><label for="muli-ans{{ $key }}" class="inline">
                                                        <p class="inline mb-0">{{ $value->ans }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                        @php
                                            $answers = explode('-',$item->user_ans);
                                        @endphp
                                        @foreach ($answers as $key => $answer)
                                            <script>
                                                document.querySelector('#muli-ans{{ $answer }}').checked = true;
                                            </script>
                                        @endforeach
                                        @if ($data->hasPages())
                                            <table class="d-flex justify-content-center">
                                                <tr>
                                                    {{-- Previous Page Link --}}
                                                    @if ($data->onFirstPage())
                                                        <td> <i class="fa fa-chevron-left disabled" style="font-size:36px"></i> </td>
                                                    @else
                                                        <td> <a href="{{ $data->previousPageUrl() }}"><i class="fa fa-chevron-left" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                    @endif
                                                    {{-- Next Page Link --}}
                                                    @if ($data->hasMorePages())
                                                        <td> <a href="{{ $data->nextPageUrl() }}" ><i class="fa fa-chevron-right" style="font-size:36px;color:#63BA52"></i></a> </td>
                                                    @else
                                                        <td> <i class="fa fa-chevron-left disabled ml-5" style="font-size:36px"></i> </td>
                                                    @endif
                                                </tr>
                                            </table>
                                        @endif
                                    @endif
                                    {{-- end --}}
                                @endif

                            </div>
                        </div>

                        <table class="d-flex justify-content-center mt-4">
                            <tr>
                                <td>
                                    <a class="btn btn-info mr-5 bg-danger finish-exam" href="{{ url('q-bank/mock/time/finish/'.Auth::user()->id.'/'.$id) }}" style="border-radius: 3px;border: none;padding: 10px 25px">FINISH</a>
                                </td>
                                <td>
                                    <a class="btn btn-success save-and-exit-exam" href="{{ url('/') }}" style="border-radius: 3px;border: none;padding: 10px 25px">SAVE & EXIT</a>
                                </td>
                            </tr>
                        </table>

                        {{-- Hints & Lab Value --}}
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
                                            <button type="submit" class="btn btn-info col-12" onclick="FindNext ();">Search</button>
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
                        </div> {{-- Hints & Lab Value end here --}}

                    </div> 
                    {{-- Right part end here --}}

                    {{-- Left part of the exam for mobile--}}
                    <div class="col-md-3" id="mobile">
                        <div class="center col-12">
                            <div class="row">
                                <div class="col-md-12 time_for_mobile">
                                    <span id="total_exam_time">Total Exam Time: </span>
                                    <span class="text-center" id="time_m"></span>
                                </div>

                                <div class="col-md-12 one_minute_time_for_mobile">
                                    <span id="per_question_time">Per Question Time: </span>
                                    <span class="text-center" id="one_minute_time_mobile"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="area_first__">
                                    <p class="text-center text-uppercase heading__n">QUESTION BANK</p>
                                    <div class="center col-12 pagination_list">
                                        <div class="row block_ justify-content-center">
                                            @for ($i = 1; $i <= $total_question; $i++)
                                                @if (isset($_GET['page']))
                                                    @if ($i == $_GET['page'])
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @else
                                                    @if ($i == '1')
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box active-search-box m-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @else
                                                        <a href="{{ url('q-bank/random/exam/'.$id.'?page='.$i) }}" class="search-box ml-1 mb-1 col-x-1 question_no"><span id="{{$i}}">{{ $i }}</span></a>
                                                    @endif
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
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

        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var Interval = setInterval(function () {
                let hours = parseInt(timer / (60 * 60));
                minutes = parseInt( (timer/60)%60 , 10);
                seconds = parseInt( timer % 60 , 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = hours + ':' + minutes + ":" + seconds;
                document.querySelector('#input_time').value = hours + ':' + minutes + ":" + seconds;

                if (seconds%5 == '0') {
                    // ajax request
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                        }
                    };
                    xhttp.open("GET", "{{ url('q-bank/mock/time/'.Auth::user()->id.'/'.$id) }}"+"/"+hours +':' + minutes + ":" + seconds, true);
                    xhttp.send();
                }

                if (--timer < 0) {
                    alert('finished');
                    clearInterval(Interval);
                    // ajax request
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            window.location.href = "{{ url('q-bank/random/exam/result/'.$id) }}";
                        }
                    };
                    xhttp.open("GET", "{{ url('q-bank/mock/time/finish/'.Auth::user()->id.'/'.$id) }}", true);
                    xhttp.send();

                }

            }, 1000);
        }

        function startOneMinuteTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var Interval = setInterval(function () {
                let hours = parseInt(timer / (60 * 60));
                minutes = parseInt( (timer/60)%60 , 10);
                seconds = parseInt( timer % 60 , 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;
                document.querySelector('#input_time').value = hours + ':' + minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(Interval);
                }

            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = {{ $count_down }},
                display = document.querySelector('#time'),
                one_minute_display = document.querySelector('#one_minute_time'),
                one_minute_display_mobile = document.querySelector('#one_minute_time_mobile'),
                display2 = document.querySelector('#time_m');
            startTimer(fiveMinutes, display);
            startTimer(fiveMinutes, display2);
            startOneMinuteTimer(60, one_minute_display);
            startOneMinuteTimer(60, one_minute_display_mobile);
        };
    </script>
    <script>
        // chart js
        $('.horizontal .progress-fill span').each(function(){
            var percent = $(this).html();
            $(this).parent().css('width', percent);
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
