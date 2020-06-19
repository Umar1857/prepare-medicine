@extends('frontend.master-frontend')

@section('content')
    <br>

    {{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Webinar</p>
            </div>
        </div>
        <!--Event Area Start-->
        <div class="event-details-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col--12">
                        <div class="events-details-right-sidebar">
                            <div class="events-details-img1 img-full">
                                <h3>{{$webinar->title}}</h3>
                                <img alt="" src="{{url('storage/webinar/'.$webinar->image)}}" width="870px" height="490px">
                            </div>
                            <div class="events-details-all">
                                <div class="events-details-time">
                                    <div class="time-icon">
                                        <i class="zmdi zmdi-time"></i>
                                    </div>
                                    <div class="time-text">
                                        <span>Start Time</span>
                                        <p class="time-mrg">{{date('h:i a', strtotime($webinar->start))}}</p>
                                        <p>{{date('D, M d, Y', strtotime($webinar->start))}}</p>
                                    </div>
                                </div>
                                <div class="events-details-time mrg-xs">
                                    <div class="time-icon">
                                        <i class="zmdi zmdi-flag"></i>
                                    </div>
                                    <div class="time-text">
                                        <span>End Time</span>
                                        <p class="time-mrg">{{date('h:i a', strtotime($webinar->end))}}</p>
                                        <p>{{date('D, M d, Y', strtotime($webinar->end))}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="about-lectures">
                                <h3>Webinar Description</h3>
                                <p>{!! $webinar->description !!}</p>
                            </div>
                            <div class="event-content">
                                <h3 class="content2">Webinar Content</h3>
                                <p>{!! $webinar->content !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-widget">
                            <div class="single-sidebar-widget">
                                <h4 class="title">Recent Webinars</h4>
                                @if(!$recentWebinars->isEmpty())
                                    <div class="recent-content">
                                        @foreach($recentWebinars as $webinar)
                                            <div class="recent-content-item">
                                                <a href="#"><img src="{{url('storage/webinar/'.$webinar->image)}}" width="70px" height="70px" alt=""></a>
                                                <div class="recent-text">
                                                    <h4><a href="#">{{$webinar->title}}</a></h4>
                                                    <p>{!! str_limit($webinar->description, 20) !!}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No Recent Webinars Found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Event Area-->
    </div>
@endsection
