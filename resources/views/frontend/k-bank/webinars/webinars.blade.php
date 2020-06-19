@extends('frontend.master-frontend')

@section('content')
    <br>

    {{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Webinars</p>
            </div>
        </div>
        <!--Event Area Start-->
        <div class="section-padding bg-white event-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper">
                            <div class="section-title">
                                <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">OUR WEBINARS</h2>
                                <p class="text-center">There are many variations of passages</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($webinars as $webinar)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-event-item event-style-2">
                                <div class="single-event-image">
                                    <a href="{{route('getWebinarDetail', $webinar->id)}}">
                                        <img src="{{url('storage/webinar/'.$webinar->image)}}" alt="">
                                        <span>{{date('d M', strtotime($webinar->start))}}</span>
                                    </a>
                                </div>
                                <div class="single-event-text">
                                    <h3><a href="{{route('getWebinarDetail', $webinar->id)}}">{{$webinar->title}}</a></h3>
                                    <div class="single-item-comment-view">
                                        <span><i class="zmdi zmdi-calendar"></i>{{date('D, M d, Y', strtotime($webinar->start))}}</span>
                                        <span><i class="zmdi zmdi-time"></i>{{date('h:i a', strtotime($webinar->start))}}</span>
                                    </div>
                                    <p>{!! str_limit($webinar->description, 50) !!}</p>
                                    <a class="button-default" href="{{route('getWebinarDetail', $webinar->id)}}">LEARN Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--End of Event Area-->
    </div>
@endsection
