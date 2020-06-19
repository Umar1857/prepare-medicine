@extends('frontend.master-frontend')
@section('content')
    <br>

    <div class='container-fluid'>
        <div class='page_banner_img_common'>
            <img src='/frontend/images/pages-banner.png' class='img-fluid'>
            <div class='overlay__'>
                <p>Courses</p>
            </div>
        </div>

        <!--Search Category Start-->
        <div class="search-category">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#" method="post">
                            <div class="form-container d-flex justify-content-between">
                                <div class="col box-select">
                                    <div class="select large">
                                        <select name="category">
                                            <option value="">Select a Speciality</option>
                                            @foreach($specialities as $speciality)
                                                <option value="{{$speciality->id}}">{{$speciality->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select small">
                                        <select name="date">
                                            <option>Price</option>
                                            <option>Price less than $50</option>
                                            <option>Price less than $100</option>
                                            <option>Price less than $150</option>
                                            <option>Price less than $200</option>
                                            <option>Price less than $250</option>
                                        </select>
                                    </div>

                                    <div class="select medium">
                                        <select name="date">
                                            <option value="">Select Course Type</option>
                                            <option value="1">Online</option>
                                            <option value="0">Face to Face</option>
                                        </select>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success">Search Course</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Search Category End-->
        <!--Course Area Start-->
        <div class="course-area bg-white section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper">
                            <div class="section-title">
                                <h3>POPULAR COURSES</h3>
                                <p>There are many variations of passages of Lorem Ipsum</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="single-item mb-50">
                                <div class="single-item-image overlay-effect">
                                    <a href="{{route('getCourseDetail', $course->id)}}"><img src="{{url('storage/plab-courses/'.$course->image)}}" alt=""></a>
                                    <div class="courses-hover-info">
                                        <div class="courses-hover-action">
                                            <p>{{$course->user->f_name.' '.$course->user->s_name}}</p>
                                            <span class="crs-separator">/</span>
                                            <p>Professor</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-item-text">
                                    <h4><a href="{{route('getCourseDetail', $course->id)}}">{{$course->title}}</a></h4>
                                    <p>{!! str_limit($course->description, 30) !!}</p>
                                    <div class="single-item-content">
                                        <div class="single-item-comment-view">
                                            <span><i class="zmdi zmdi-accounts"></i>59</span>
                                            <span><i class="zmdi zmdi-favorite"></i>19</span>
                                        </div>
                                        <div class="single-item-rating">
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star-half"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!--End of Course Area-->

    </div>

@endsection
