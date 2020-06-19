@extends('frontend.master-frontend')

@section('content')
    <br>
    <!--Course Area Start-->
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Courses</p>
            </div>
        </div>
        <div class="course-details-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col--12">
                        <div class="course-details-right-sidebar">
                            <div class="events-details-img1 img-full">
                                <h3>{{$course->title}}</h3>
                                <img alt="" src="{{url('storage/plab-courses/'.$course->image)}}" width="870px" height="490px">
                            </div>

                            <div class="events-details-all">
                                <div class="events-details-time">
                                    <div class="time-icon">
                                        <i class="zmdi zmdi-time"></i>
                                    </div>
                                    <div class="time-text">
                                        <span>Start Time</span>
                                        <p class="time-mrg">{{date('h:i a', strtotime($course->start))}}</p>
                                        <p>{{date('D, M d, Y', strtotime($course->start))}}</p>
                                    </div>
                                </div>
                                <div class="events-details-time mrg-xs">
                                    <div class="time-icon">
                                        <i class="zmdi zmdi-flag"></i>
                                    </div>
                                    <div class="time-text">
                                        <span>End Time</span>
                                        <p class="time-mrg">{{date('h:i a', strtotime($course->end))}}</p>
                                        <p>{{date('D, M d, Y', strtotime($course->end))}}</p>
                                    </div>
                                </div>
                                @if(!$course->is_online)
                                    <div class="events-details-time mrg-xs">
                                        <div class="time-icon">
                                            <i class="zmdi zmdi-pin"></i>
                                        </div>
                                        <div class="time-text">
                                            <span>Address</span>
                                            <p>{{$course->address}}</p>
                                            <p>{{$course->city.', '.$course->state}}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{--<div class="course-duration mb-30">
                                <iframe src="https://www.youtube.com/embed/WHSUHyn1fR4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>--}}
                            <div class="about-lectures">
                                <h3>Course Description</h3>
                                <p>{!! $course->description !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="sidebar-widget">
                            <div class="single-sidebar-widget">
                                <h3 class="sidebar-title">Courses Information </h3>
                                <ul class="course-menu">
                                    <li>Course Type :<span>{{$course->is_online ? 'Online' : 'Face to Face' }}</span></li>
                                    <li>Starts On :<span>{{date('d.m.Y', strtotime($course->start))}}</span></li>
                                    <li>Ends On :<span>{{date('d.m.Y', strtotime($course->end))}}</span></li>
                                    <li>Duration :<span>{{$course->duration}}</span></li>
                                    <li>Lectures :<span>{{$course->lectures}} Session</span></li>
                                    <li>Time :<span>{{$course->time}}</span></li>
                                    <li>Price :<span>${{$course->price}}</span></li>
                                </ul>
                            </div>

                            <div class="enroll-section">
                                <button class="btn btn-success btn-lg enroll-btn">GET ENROLLED</button>
                            </div>

                            <div class="single-sidebar-widget">
                                <h4 class="title">Recent Courses</h4>
                                @if(!$recentCourses->isEmpty())
                                    <div class="recent-content">
                                        @foreach($recentCourses as $course)
                                            <div class="recent-content-item">
                                                <a href="#"><img src="{{url('storage/plab-courses/'.$course->image)}}" alt=""></a>
                                                <div class="recent-text">
                                                    <h4><a href="#">{{$course->title}}</a></h4>
                                                    <p>{!! str_limit($course->description, 30) !!}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No Recent Courses Found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Course Area End-->
    </div>
@endsection
