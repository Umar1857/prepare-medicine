@extends('frontend.master-frontend')

@php
    //allover progress
    $other_index__1 = $other_index__2 = $other_index__3 = $other_index__4 = $other_index__5 = $other_index__6 = $other_index__7 = $other_index__8 = 0;
    $user_index__1 = $user_index__2 = $user_index__3 = $user_index__4 = $user_index__5 = $user_index__6 = $user_index__7 = $user_index__8 = 0;

    //for others
    if($over__all[1] <= 13){
        $other_index__1 = $over__all[1];
    }elseif($over__all[1] > 13 && $over__all[1] <= 25){
        $other_index__2 = $over__all[1];
    }elseif($over__all[1] > 25 && $over__all[1] <=37){
        $other_index__3 = $over__all[1];
    }elseif($over__all[1] > 37 && $over__all[1] <=50){
        $other_index__4 = $over__all[1];
    }elseif($over__all[1] > 50 && $over__all[1] <=62){
        $other_index__5 = $over__all[1];
    }elseif($over__all[1] > 62 && $over__all[1] <=75){
        $other_index__6 = $over__all[1];
    }elseif($over__all[1] > 75 && $over__all[1] <=87){
        $other_index__7 = $over__all[1];
    }elseif($over__all[1] > 87){
        $other_index__8 = $over__all[1];
    }

    //for user
    if($over__all[0] <= 13){
        $user_index__1 = $over__all[0];
    }elseif($over__all[0] > 13 && $over__all[0] <= 25){
        $user_index__2 = $over__all[0];
    }elseif($over__all[0] > 25 && $over__all[0] <=37){
        $user_index__3 = $over__all[0];
    }elseif($over__all[0] > 37 && $over__all[0] <=50){
        $user_index__4 = $over__all[0];
    }elseif($over__all[0] > 50 && $over__all[0] <=62){
        $user_index__5 = $over__all[0];
    }elseif($over__all[0] > 62 && $over__all[0] <=75){
        $user_index__6 = $over__all[0];
    }elseif($over__all[0] > 75 && $over__all[0] <=87){
        $user_index__7 = $over__all[0];
    }elseif($over__all[0] > 87){
        $user_index__8 = $over__all[0];
    }


@endphp


@section('js-css')
    <style>
        .panel-white{
            background: white;
            padding: 10px;
        }
        .btn-left{
            float: right;
        }
        .delete{
            color: red;
            margin-left: 5px;
        }
        .edit , .delete{
            font-size: 25px;
        }
        .edit {
            cursor: pointer;
        }

        .table-bordered thead{
            background:#F1F4F9
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
            background: #fff;
            border:1px solid #555;
        }

        .horizontal .progress-fill {
            position: relative;
            background: #438B28;
            height: 30px;
            width: 50%;
            color: #fff;
            text-align: center;
            font-family: "Lato","Verdana",sans-serif;
            font-size: 12px;
            line-height: 30px;
        }

        .rounded .progress-track,
        .rounded .progress-fill {
            border-radius: 3px;
            /*box-shadow: inset 0 0 5px rgba(0,0,0,.2);*/
        }

        .panel .heading_ {
            text-align: center;
            text-transform: uppercase;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /*CSS by Developer Rijan*/
        .progress_bar_{
            background: #fff;
            height: 10px;
            border-radius: 5px;
            border: 1px solid #555;
            display:block;
        }
        .fill_progress__me{
            display:block;
            height:10px;
            border-radius: 5px;
            background:#4D8B12;
        }
        .fill_progress__other{
            display:block;
            height:10px;
            border-radius: 5px;
            background:#024E97;
        }
        .info_chart__ tr td{
            padding-right:10px;
        }


        /*Developed by 'Developer Rijan'*/
        .block__box{
            padding:0px;
            border:1px solid #ddd;
        }
        .block__box .progress_heading__{
            border: 1px solid #ddd;
            padding: 10px;
            font-weight: bold;
            font-size: 14px;
            margin:0;
            background:#F1F4F9;
            text-align:center;

        }
        .info__window_sm{
            padding:15px 10px 30px 10px;
        }
        .info__window_sm p{
            padding: 0;
            margin: 0;
            font-weight: bold;
            line-height: 20px;
        }



        .box_design__{
            border: 1px solid #ddd;
            border-radius: .25rem!important;
            margin: 30px 0;
            padding: 15px;
            background:#F1F4F9;
        }
        .box_design__ .block___{
            margin-bottom: 10px;
        }
        .box_design__ .block___ .heading__{
            margin:0;
            font-weight:bold;
            background:#F1F4F9 !important;
        }

        .box_design__ .block___ .progress-fill span{
            color:#000;
        }

        @media all and (max-width:575px){
            .block__box .progress_heading__ {
                padding: 10px 5px;
                font-size: 12px;
            }
        }


    </style>
    {{-- Circle Chart for verces --}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

        // Manual Exam
        google.charts.setOnLoadCallback(Manual);
        google.charts.setOnLoadCallback(ManualS);

        function Manual() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'My Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['manual'][1] }}],
                ['Wrong', {{ ($chart_data['manual'][0]-$chart_data['manual'][1]) }}],
            ]);

            var options = {
                //title: 'My Performance',
                title: ' ',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('Manual'));

            chart.draw(data, options);
        }

        function ManualS() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'All Users Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['manual'][3] }}],
                ['Wrong', {{ ($chart_data['manual'][2]-$chart_data['manual'][3]) }}],
            ]);

            var options = {
                //title: 'All Users Performance',
                title: ' ',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('ManualS'));

            chart.draw(data, options);
        }
        // End Manual

        // Random Exam
        google.charts.setOnLoadCallback(Random);
        google.charts.setOnLoadCallback(RandomS);

        function Random() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'My Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['random'][1] }}],
                ['Wrong', {{ ($chart_data['random'][0]-$chart_data['random'][1]) }}],
            ]);

            var options = {
                //title: 'My Performance',
                title: ' ',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('Random'));

            chart.draw(data, options);
        }

        function RandomS() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'All Users Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['random'][3] }}],
                ['Wrong', {{ ($chart_data['random'][2]-$chart_data['random'][3]) }}],
            ]);

            var options = {
                //title: 'All Users Performance',
                title: ' ',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('RandomS'));

            chart.draw(data, options);
        }
        // End Random

        // Recall Exam
        google.charts.setOnLoadCallback(Recall);
        google.charts.setOnLoadCallback(RecallS);

        function Recall() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'My Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['recall'][1] }}],
                ['Wrong', {{ ($chart_data['recall'][0]-$chart_data['recall'][1]) }}],
            ]);

            var options = {
                //title: 'My Performance',
                title: ' ',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,

            };

            var chart = new google.visualization.PieChart(document.getElementById('Recall'));

            chart.draw(data, options);
        }

        function RecallS() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'All Users Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['recall'][3] }}],
                ['Wrong', {{ ($chart_data['recall'][2]-$chart_data['recall'][3]) }}],
            ]);

            var options = {
                title: 'All Users Performance',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('RecallS'));

            chart.draw(data, options);
        }
        // End Recall

        // Category Exam
        google.charts.setOnLoadCallback(Category);
        google.charts.setOnLoadCallback(CategoryS);

        function Category() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'My Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['category'][1] }}],
                ['Wrong', {{ ($chart_data['category'][0]-$chart_data['category'][1]) }}],
            ]);

            var options = {
                title: 'My Performance',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('Category'));

            chart.draw(data, options);
        }

        function CategoryS() {

            var data = google.visualization.arrayToDataTable([
                //['Task', 'All Users Performance'],
                ['Task', ' '],
                ['Correct',      {{ $chart_data['category'][3] }}],
                ['Wrong', {{ ($chart_data['category'][2]-$chart_data['category'][3]) }}],
            ]);

            var options = {
                title: 'All Users Performance',
                colors: ['#63BA52', '#E8372E'],
                legend: { position: 'bottom' },
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('CategoryS'));

            chart.draw(data, options);
        }
        // End Category



        //make over all
        google.charts.setOnLoadCallback(drawOverAllProgress_);

        function drawOverAllProgress_() {


            var data = google.visualization.arrayToDataTable([
                ['Percentage', 'Others', 'You'],
                ['12.5%',  {{ $other_index__1 }},  {{ $user_index__1 }}],
                ['25%',    {{ $other_index__2 }},  {{ $user_index__2 }}],
                ['37.5%',  {{ $other_index__3 }},  {{ $user_index__3 }}],
                ['50%',    {{ $other_index__4 }},  {{ $user_index__4 }}],
                ['62.5%',  {{ $other_index__5 }},  {{ $user_index__5 }}],
                ['75%',    {{ $other_index__6 }},  {{ $user_index__6 }}],
                ['87.5%',  {{ $other_index__7 }},  {{ $user_index__7 }}],
                ['100%',   {{ $other_index__8 }},  {{ $user_index__8 }}]
            ]);

            var options = {
                //title: 'Overall Progress',
                title: '',
                curveType: 'function',
                legend: { position: 'top' },
                backgroundColor:"#F4F4F4",
            };

            var chart = new google.visualization.LineChart(document.getElementById('overAllProgress__'));

            chart.draw(data, options);


        }
    </script>

@endsection
@section('content')
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>My Progress</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Random Progress</h4>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>My Performance</h6>
                        <div id="Random" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>All Users Performance</h6>
                        <div id="RandomS" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            {{-- chart --}}

            <div class="panel-body">
                <div class="table-responsive mb-4 mb-md-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" width="20%">Mock</th>
                            <th scope="col" width="40%">Performance</th>
                            <th scope="col" width="13.33%" style='color:red'><i class="far fa-times-circle"></i></th>
                            <th scope="col" width="13.33%" style='color:#63BA52'><i class="far fa-check-circle"></i></th>
                            <th scope="col" width="13.33%"><i class="far fa-dot-circle"></i></th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($random as $key=>$item)
                            <tr>
                                <th scope="row">{{ 'Mock '.($key+1) }}</th>

                                <td>
                                    <div style="width:100%">
                                        <div style="width:20%;display:inline-block;"><small>{{ $item->right_ans ? number_format( ($item->right_ans/($item->right_ans+$item->wrong_ans))*100, 2) : 0 }}%</small></div>
                                        <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class="fill_progress__me" style='width:{{ $item->right_ans ? number_format( ($item->right_ans/($item->right_ans+$item->wrong_ans))*100, 2) : 0}}%'></span></div></div>
                                    </div>
                                    <div style="width:100%">
                                        <div style="width:20%;display:inline-block;"><small>{{ !empty($random_others[$key]) ? number_format( ($random_others[$key]['right']/($random_others[$key]['right']+$random_others[$key]['wrong']))*100, 2) : '0'}}%</small></div>
                                        <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class='fill_progress__other' style='width:{{ !empty($random_others[$key]) ? number_format( ($random_others[$key]['right']/($random_others[$key]['right']+$random_others[$key]['wrong']))*100, 2) : '0'}}%'></span></div></div>
                                    </div>
                                </td>

                                <td>{{ $item->wrong_ans }}</td>
                                <td>{{ $item->right_ans }}</td>
                                <td>{{ $item->wrong_ans + $item->right_ans }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <table class='info_chart__'>
                        <tr>
                            <td><p><span style="color:#4D8B12"><i class="fas fa-square-full"></i></span> Me</p></td>
                            <td><p><span style="color:#05569B"><i class="fas fa-square-full"></i></span> Everyone Else</p></td>
                            <td><p><span style="color:#63BA52"><i class="far fa-check-circle"></i></span> Correct</p></td>
                            <td><p><span style="color:red"><i class="far fa-times-circle"></i></span> Incorrect</p></td>
                            <td><p><span class='info__total'><i class="far fa-dot-circle"></i></span> Total</p></td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Manual Progress</h4>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>My Performance</h6>
                        <div id="Manual" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>All Users Performance</h6>
                        <div id="ManualS" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
            {{-- chart --}}
            <div class="panel-body">
                <div class="table-responsive mb-4 mb-md-0">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col" width="20%">Mock</th>
                            <th scope="col" width="40%">Perfomance</th>
                            <th scope="col" width="13.33%" style='color:red'><i class="far fa-times-circle"></i></th>
                            <th scope="col" width="13.33%" style='color:#63BA52'><i class="far fa-check-circle"></i></th>
                            <th scope="col" width="13.33%"><i class="far fa-dot-circle"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($manual as $key=>$item)
                            <tr>
                                <th scope="row">{{ 'Mock '.($key+1) }}</th>

                                <td>
                                    <div style="width:100%">
                                        <div style="width:20%;display:inline-block;"><small>{{ $item->right_ans ? number_format( ($item->right_ans/($item->right_ans+$item->wrong_ans))*100, 2) : 0}}%</small></div>
                                        <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class="fill_progress__me" style='width:{{ $item->right_ans ? number_format( ($item->right_ans/($item->right_ans+$item->wrong_ans))*100, 2) : 0}}%'></span></div></div>
                                    </div>
                                    <div style="width:100%">
                                        <div style="width:20%;display:inline-block;"><small>{{ !empty($manual_others[$key]) ? number_format( ($manual_others[$key]['right']/($manual_others[$key]['right']+$manual_others[$key]['wrong']))*100, 2) : '0'}}%</small></div>
                                        <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class='fill_progress__other' style='width:{{ !empty($manual_others[$key]) ? number_format( ($manual_others[$key]['right']/($manual_others[$key]['right']+$manual_others[$key]['wrong']))*100, 2) : '0'}}%'></span></div></div>
                                    </div>
                                </td>

                                <td>{{ $item->wrong_ans }}</td>
                                <td>{{ $item->right_ans }}</td>
                                <td>{{ $item->right_ans + $item->wrong_ans }}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    <table class='info_chart__'>
                        <tr>
                            <td><p><span style="color:#4D8B12"><i class="fas fa-square-full"></i></span> Me</p></td>
                            <td><p><span style="color:#05569B"><i class="fas fa-square-full"></i></span> Everyone Else</p></td>
                            <td><p><span style="color:#63BA52"><i class="far fa-check-circle"></i></span> Correct</p></td>
                            <td><p><span style="color:red"><i class="far fa-times-circle"></i></span> Incorrect</p></td>
                            <td><p><span class='info__total'><i class="far fa-dot-circle"></i></span> Total</p></td>
                        </tr>
                    </table>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Recall Progress</h4>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>My Performance</h6>
                        <div id="Recall" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>All Users Performance</h6>
                        <div id="RecallS" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Speciality Progress</h4>
            </div>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>My Performance</h6>
                        <div id="Category" style="height: 300px; width: 100%;"></div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="block__box">
                        <h6 class='progress_heading__'>All Users Performance</h6>
                        <div id="CategoryS" style="height: 300px; width: 100%;"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Performance Analysis by Specialities</h4>
            </div>
            <div class="table-responsive mb-4 mb-md-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="20%">Speciality</th>
                        <th scope="col" width="40%">Perfomance</th>
                        <th scope="col" width="13.33%" style='color:red'><i class="far fa-times-circle"></i></th>
                        <th scope="col" width="13.33%" style='color:#63BA52'><i class="far fa-check-circle"></i></th>
                        <th scope="col" width="13.33%"><i class="far fa-dot-circle"></i></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories_perfonamce as $key=>$performance)
                        <tr>
                            <th scope="row">{{ $performance[0] }}</th>

                            <td>
                                <div style="width:100%">
                                    <div style="width:20%;display:inline-block;"><small>{{ $performance[1] }}%</small></div>
                                    <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class="fill_progress__me" style='width:<?php echo $performance[1];?>%'></span></div></div>
                                </div>
                                <div style="width:100%">
                                    <div style="width:20%;display:inline-block;"><small>{{ $performance[2] }}%</small></div>
                                    <div style="width:70%;display:inline-block"><div class="progress_bar_"><span class='fill_progress__other' style='width:<?php echo $performance[2];?>%'></span></div></div>
                                </div>
                            </td>

                            <td>{{ $performance[3] }}</td>
                            <td>{{ $performance[4] }}</td>
                            <td>{{ $performance[5] }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>

                <table class='info_chart__'>
                    <tr>
                        <td><p><span style="color:#4D8B12"><i class="fas fa-square-full"></i></span> Me</p></td>
                        <td><p><span style="color:#05569B"><i class="fas fa-square-full"></i></span> Everyone Else</p></td>
                        <td><p><span style="color:#63BA52"><i class="far fa-check-circle"></i></span> Correct</p></td>
                        <td><p><span style="color:red"><i class="far fa-times-circle"></i></span> Incorrect</p></td>
                        <td><p><span class='info__total'><i class="far fa-dot-circle"></i></span> Total</p></td>
                    </tr>
                </table>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-white">
            <div class="panel-heading clearfix">
                <h4 class="panel-title heading_">Overall Progress</h4>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="block__box">
                        <h6 class="progress_heading__ text-left">Standard Deviation Graph</h6>
                        <div class='info__window_sm'>
                            <p>Your Cumulative Average = {{ $over__all[2] }}%</p>
                            <p>Your Percentile = {{ $over__all[0] }}th percentile</p>
                            <p>Percentage of users in 8 portions of the curve</p>
                        </div>
                        <div id="overAllProgress__"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <br/>
@endsection
@section('js')
    <script>
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
@endsection
