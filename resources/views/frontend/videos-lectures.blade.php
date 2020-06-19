@extends('frontend.master-frontend')
@section('js-css')

    <style>
        .user-name-hidden{
            color:red;
            display: ruby;
        }
        .user-name-show{
            color:#63BA52;
            display: ruby;
        }
        .user-feedback{
            margin-left: 25px;
        }
        .edit-btn{
            color: green;
        }
        .panel-warning{
            background: #fff;
            padding: 10px
        }
        .right{
            float: right;
        }
        .border{
            border: 10px solid green;
        }
        .block{
            display: block;
        }
        li{
            list-style-type: none;
        }

        .notification{
            text-align: center;
            background-color: red;
            color: #fff;
            font-weight: bold;
            padding: 20px 10px;
            font-size: 16px;
            margin-top: 50px;
            margin-bottom: 15px
        }
    </style>

@endsection
@section('content')
<br>
<br>


@if(Auth::user()->role == 2 || 
    Auth::user()->role == 3 ||
    Auth::user()->role == 5 ||
    Auth::user()->role == 6
)
    <div class="container text-center" style="margin-bottom: 100px">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Video Lectures</p>
            </div>
        </div>
        
        <h4 class="notification">{{ 'SORRY! You Need to Upgrade Your Plan to Advance/Professional to Access' }}</h4>
        <a href="{{ route('root_page') }}#most_popular_courses" class="btn">Upgrade Now</a>
    </div>

@else

{{--  data fetch from Database !!  --}}
<div class="panel panel-warning">
    <div class="panel-body">
        <div class="container">
            <div class="row">
                @foreach ($data as $item)
                    <div class="border col-4 embed-responsive embed-responsive-21by9">
                            <iframe  class="col-12 embed-responsive-item" src="{{ $item->path }}" allowfullscreen></iframe>
                    </div>
                @endforeach
            </div>
            <br>
            <span>
                {{ $data->links() }}
            </span>
        </div>
    </div>
</div>

@endif

<br>

@endsection
