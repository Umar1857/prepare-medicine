@extends('frontend.master-frontend')
@section('content')
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Lab Value</p>
            </div>
        </div>
        
        {{--  data fetch from Database !!  --}}
        {!! $data !!}

    </div>
    <br>
@endsection
