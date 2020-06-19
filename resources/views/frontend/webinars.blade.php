@extends('frontend.master-frontend')
@section('js-css')
<style type="text/css">
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


@if(Auth::user()->role == 2 || 
	Auth::user()->role == 3 ||
	Auth::user()->role == 5 ||
	Auth::user()->role == 6
)
	<div class="container-fluid text-center" style="margin-bottom: 100px">
	    <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Webinars</p>
            </div>
        </div>
        
		<h4 class="notification">{{ 'SORRY! You Need to Upgrade Your Plan to Advance/Professional to Access' }}</h4>
		<a href="{{ route('root_page') }}#most_popular_courses" class="btn">Upgrade Now</a>
	</div>

@else

{{--  data fetch from Database !!  --}}

@endif


@endsection
