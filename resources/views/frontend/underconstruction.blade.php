@extends('frontend.master-frontend')
@section('js-css')

    <style>
        .user-name{
            color:red;
            display: ruby;
        }
        .user-feedback{
            margin-left: 25px;
        }
        .edit-btn{
            color: green;
        }
    </style>

@endsection
@section('content')
<br>

    {{--  data fetch from Database !!  --}}
    <br>
    <div class="container-fluid">
        <!--<div class='page_banner_img_common'>-->
        <!--    <img src='/frontend/images/pages-banner.png' class='img-fluid'>-->
        <!--    <div class='overlay__'>-->
        <!--        <p>Under Constuction</p>-->
        <!--    </div>-->
        <!--</div>-->
        
        <div class='text-center'>
            <img src='/frontend/images/unserconstruction.png' class='img-fluid'>
        </div>
    </div>
    <br>
@endsection
