@extends('frontend.master-frontend')
@section('content')
    <br>

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>About Us</p>
            </div>
        </div>
        <!--About Area Start-->
        <div class="about-area mt-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about-container">
                            <p>{!! $data !!}</p>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <!--About Image Area Start-->
                        <div class="about-image-area img-full">
                            <img src="{{url('frontend/images/about/about1.jpg')}}" alt="">
                        </div>
                        <!--About Image Area End-->
                    </div>
                </div>
            </div>
        </div>
        <!--End of About Area-->

        <!-- Project Count Area Start -->
        <div class="project-count-area section-ptb-160 project-count-bg">
            <div class="container">

                <div class="row">
                    <div class="col-lg-8  ml-auto mr-auto">
                        <!-- section-title -->
                        <div class="section-title">
                            <h4>about us</h4>
                            <h3 class="text-white">SOME IMPORTANT FACTS</h3>
                        </div><!--// section-title -->
                    </div>
                </div>

                <div class="project-count-inner">
                    <div class="row">
                        <div class="col-lg-10 ml-auto mr-auto">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6">
                                    <!-- counter start -->
                                    <div class="counter text-center">
                                        <h3 class="counter-active">7</h3>
                                        <p>Courses</p>
                                    </div>
                                    <!-- counter end -->
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <!-- counter start -->
                                    <div class="counter text-center">
                                        <h3 class="counter-active">6000</h3>
                                        <p>Q-Bank</p>
                                    </div>
                                    <!-- counter end -->
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <!-- counter start -->
                                    <div class="counter text-center">
                                        <h3 class="counter-active">150</h3>
                                        <p>Members</p>
                                    </div>
                                    <!-- counter end -->
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <!-- counter start -->
                                    <div class="counter text-center">
                                        <h3 class="counter-active">18</h3>
                                        <p>Countries</p>
                                    </div>
                                    <!-- counter end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Project Count Area End -->

        <!--Teachers Area Start-->
        <div class="teachers-area section-padding bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title-wrapper">
                            <div class="section-title">
                                <h3>OUR TEACHERS</h3>
                                <p>Our Honored and Respected Teachers</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$teachers->isEmpty())
                    <div class="row">
                        @foreach($teachers as $teacher)
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="agent mb-30">
                                    <div class="image img-full">
                                        <div class="social">
                                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                            <a href="#" class="google"><i class="fa fa-google-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="title"><a href="#">{{$teacher->f_name.' '.$teacher->s_name}}</a></h4>
                                        <a href="#" class="email">{{$teacher->email}}</a>
                                        <span class="properties">Teacher</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <!--Teachers Area End-->
    </div>
@endsection
