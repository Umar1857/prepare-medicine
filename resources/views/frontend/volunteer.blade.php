@extends('frontend.master-frontend')
@section('content')
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Volunteer</p>
            </div>
        </div>
        <div class="container">
            {{--  data fetch from Database !!  --}}
            {!! $data !!}
        </div>

    </div>
    <br>
@endsection

