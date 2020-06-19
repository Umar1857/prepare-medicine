<!Doctype html>
<html class="no-js" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home || Prepare Medicine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/favicon.ico') }}">

    <!-- CSS
    ========================= -->

    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">

    <!-- Fonts CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/material-design-iconic-font.min.css') }}">

    <!-- Fontawsome CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/font-awesome.min.css') }}">

    <!-- New pages Style CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/style-new.css') }}">

    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/plugins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/css/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/subscription-design.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">

    {{-- Custom Styles --}}
    <link rel="stylesheet" href="{{ url('frontend/css/custom-styles.css') }}">

    <!-- Modernizer JS -->
    <script src="{{ url('frontend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <style>
        .select2-container {
            display: inline;
        }
        .dropdown-submenu {
        position: relative;
        }

        .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: 15px;
        padding: 10px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px 6px;
        border-radius: 0 6px 6px 6px;
        }

        .dropdown-submenu:hover>.dropdown-menu {
        display: block;
        }

        .dropdown-submenu>a:after {
        display: block;
        content: " ";
        float: right;
        width: 0;
        height: 0;
        border-color: transparent;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        border-left-color: #cccccc;
        margin-top: 5px;
        margin-right: -10px;
        }

        .dropdown-submenu:hover>a:after {
        border-left-color: #ffffff;
        }

        .dropdown-submenu.pull-left {
        float: none;
        }

        .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
        }


        .modal-header .close{
            margin:-1rem -1rem -1rem -2rem;
        }
    </style>





    {{-- Custom Js && Css --}}
    @yield('js-css')


    <style type="text/css">
        @media only screen and (max-width: 767px) {
           .container {
              width: 100% !important;
           }
        }
    </style>


    {{-- Copy Protector CSS start from here --}}
    <style type="text/css">
        /*Way One*/
        @media print {
            html, body {
               display: none;  /* hide whole page when someone want to print */
            }
        }
    </style>

    {{-- Copy Protector CSS end from here --}}
</head>

{{-- Copy Protector JS --}}
<body oncontextmenu="return true"  class="">


<!-- Main Wrapper Start -->
<div class="main-wrapper">

    <header class="header-area fixed-top">
        <!-- header-top-area -->
        <div class="header-top-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">

                        <!-- top-contact-info -->
                        <div class="top-contact-info">
                            <ul>
                                <!-- <li><a href="#"><i class="zmdi zmdi-phone"></i> +98 558 547 589</a></li> -->
{{--                                <li><a href="{{route('contact-us')}}"><i class="zmdi zmdi-email"></i>info@preparemedicine.com</a></li>--}}
                            </ul>
                        </div><!--// top-contact-info -->

                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="top-info-right">

                            <!-- top-social -->
                            <div class="top-social">
                                <ul>

                                    <li><a target="_blank" href="https://www.facebook.com/PrepareMedicine" ><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a target="_blank" href="https://twitter.com/PrepareMedicine"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/prepare.medicine"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a target="_blank" href="https://www.youtube.com/channel/UC-aACIkZHxVgtKs_edU96Xw"><i class="zmdi zmdi-youtube"></i></a></li>
                                    <li><a target="_blank" href="{{route('contact-us')}}"><i class="zmdi zmdi-email"></i></a></li>
                                    <li><a target="_blank" href="#" ><i class="zmdi zmdi-notifications"></i></a></li>
                                    <!-- <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li> -->
                                </ul>
                            </div><!--// top-social -->

                            <!-- login-and-register -->
                            <div class="login-and-register">
                                @guest
                                    <ul>
                                        <li><a href="{{ url('login') }}">Login</a></li>
                                        <li><a href="{{ url('register') }}">Register</a></li>
                                    </ul>
                                @else
                                    {{--<button class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out-alt" aria-hidden="true"></i>{{ __('Logout') }}
                                    </button>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>--}}
                                @endguest
                            </div><!--// login-and-register -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!--// header-top-area -->

        <div class="header-bottom-area header-sticky ">
            <div class="container">
                <div class="row align-items-center" style="position:relative">

                    <div class="col-lg-2 col-md-5 col-6">

                        <!-- logo-area -->
                        <div class="logo-area">
                            <a href="{{ url('/') }}"><img src="{{ url('frontend/images/logo/logo-3.png') }}" alt=""></a>
                        </div><!--// logo-area -->

                    </div>

                    <div class="col-lg-10 col-md-7 col-6">

                        <div class="header-bottom-right">
                            <!-- main-menu -->
                            <div class="main-menu">
                                <nav class="main-navigation">
                                    <ul>
                                        <li class="active"><a href="{{ url('/') }}"><i class="zmdi zmdi-home"></i> HOME</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url('about-us') }}">About Us</a></li>
                                                <li><a href="{{ url('our-team/our-team') }}">Meet the Team</a></li>
                                                <li><a href="{{ url('our-team/volunteer') }}">Become a Volunteer</a></li>
                                                <li><a href="{{ url('our-team/plab-exam') }}">About PLAB Exam</a></li>
                                                <li><a href="{{ url('our-team/plab-news') }}">NEWS & Updates</a></li>
                                                <li><a href="{{ url('our-team/useful-links-plab-1') }}">Useful Links</a></li>
                                                <li><a href="{{ url('our-team/disclaimer') }}">Disclaimer</a></li>
                                                <li><a href="{{ url('our-team/faq') }}">FAQ</a></li>
                                            </ul>
                                        </li>
                                        <li><a><i class="zmdi zmdi-storage"></i> Q-BANK</a>
                                            <ul class="sub-menu">
                                                @guest
                                                    <li><a href="/login">Login to Access</a></li>

                                               {{-- <li><a href="{{ url('course/plab-1') }}">PLAB 1</a></li>
                                                    <li class="dropdown-submenu"><a >MRCP</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="{{ url('under-onstruction') }}">MRCP 1</a></li>
                                                            <li><a  href="{{ url('under-onstruction') }}">MRCP 2</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="dropdown-submenu"><a >FRCEM</a>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">FRCEM Primary</a></li>
                                                            <li><a  href="#">FRCEM Intermediate</a></li>
                                                        </ul>
                                                    </li> --}}
                                                @endguest
                                                @if (Auth::check())
                                                @if (Auth::user()->role >= '2' && Auth::user()->expeir_date >= date('Y-m-d'))
                                                    <li><a href="{{ url('q-bank/revision-category') }}">Revision</a></li>
                                                    <li><a href="{{ url('q-bank/mock-exam/random-mock') }}">Random Mock</a></li>
                                                    <li><a href="{{ url('q-bank/mock-exam/manual-mock') }}">Manual Mock</a></li>
                                                    <li><a href="{{ url('q-bank/recall-exam') }}">Recall Exam</a></li>
                                                    <li><a href="{{ url('q-bank/flagged-questions') }}">Flagged Questions</a></li>
                                                @endif
                                                @endif
                                            </ul>
                                        </li>

                                        <li><a><i class="zmdi zmdi-storage"></i> I-BANK</a>
                                            <ul class="sub-menu">
                                                @guest
                                                    <li><a href="/login">Login to Access</a></li>
                                                @endguest
                                                @if (Auth::check())
                                                    @if (Auth::user()->role >= '2' && Auth::user()->expeir_date >= date('Y-m-d'))
                                                        <li><a href="{{ url('i-bank/notes-bank') }}">Notes Bank</a></li>
                                                        <li><a href="{{ route('image-bank') }}">Image Bank</a></li>
                                                        <li><a href="{{ route('video-bank') }}">Video Bank</a></li>
                                                        <li><a href="{{ url('i-bank/smart-mock') }}">Smart Mock</a></li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </li>

                                        <li><a href="#"><i class="zmdi zmdi-storage"></i> K-BANK</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ url('course') }}">Courses</a></li>
                                                <li><a href="{{ route('getCourses') }}">Plab Courses</a></li>
                                                <li><a href="{{ route('getEvents') }}">Events</a></li>
                                                <li><a href="{{ route('getWebinar') }}">Webinars</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#"><i class="zmdi zmdi-male-female"></i> PLABERS</a>
                                            <ul class="sub-menu">
                                                @if (Auth::check())
                                                    @if (Auth::user()->role >= '2' && Auth::user()->expeir_date >= date('Y-m-d'))
                                                    <li><a href="{{ url('community/whatsApp-groups') }}">WhatsApp Groups</a></li>
                                                    <li><a href="{{ url('community/facebook-groups') }}">Facebook Groups</a></li>

                                                    <li><a href="{{ url('community/add-questions') }}">Add Questions</a></li>
                                                    <li><a href="{{ url('community/community-question') }}">Plaber's Questions</a></li>
                                                    @endif
                                                @else
                                                <li><a href="/login">Login to Access</a></li>
                                                @endif
                                            </ul>
                                        </li>
                                        @if (Auth::check())
                                            <li><a href="#"><i class="zmdi zmdi-accounts"></i> ACCOUNT</a>
                                                <ul class="sub-menu">
                                                    <li><a href="{{ url('account/subscription') }}">Subscription</a></li>
                                                    @if (Auth::check())
                                                        <li><a href="{{ url('account/progress') }}">Progress</a></li>
                                                        <li><a href="{{ url('account/account-reset') }}">Reset Account</a></li>
                                                        <li><a href="{{ url('account/change-password') }}">Reset Password</a></li>
{{--                                                        <li><a href="{{ url('account/notification') }}"><i class="fa fa-bell" aria-hidden="true"></i> Notificatons</a></li>--}}
                                                        <li class="nav-item dropdown" style="background: #fff;">
                                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                               onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                                <i class="fa fa-sign-out-alt" aria-hidden="true"></i>{{ __('Logout') }}
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div><!--// main-menu -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="mobile-menu d-block d-lg-none"></div>
                    </div>


                </div>
            </div>
        </div>

    </header>



    @yield('content')





    </div>
    <!-- Main Wrapper End -->

<!-- Footer Area -->
<footer>

    <!-- Footer Top Area -->
    <div class="footer-top py-md-5 py-4">
        <div class="container-fluid">
            <div class="row align-items-center">

                <div class="col-md-4 col-12 mb-md-0 mb-4">
                    <div class="footer-single-block text-center">
                        <div class="footer-logo">
                            <a href="index.html"><img src="{{ url('frontend/images/logo/Asset 5@4x.png') }}" alt=""></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-12 mb-sm-0 mb-4">
                    <div class="footer-single-block text-center">
                        <p class="footer-dec">An online learning community for medical professionals who are preparing to sit the PLAB-1 exam towards GMC registration</p>
                    </div>
                </div>

                {{-- OLD
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="footer-block">
                        <h5>Quick Links</h5>
                        <ul class="footer-list">
                            <li><a href="{{ route('disclaimer.page') }}">Disclaimer</a></li>
                            <li><a href="{{ route('termsConditions.page') }}">Terms and Conditions</a></li>
                            <li><a href="{{ route('webinars.page') }}">Webinars</a></li>
                            <li><a href="#">Tutorials</a></li>
                            <li><a href="#">GMC</a></li>
                            <li><a href="#">Discount Program</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt--35">
                    <div class="footer-block">
                        <h5>Popular Courses</h5>
                        <ul class="footer-courses">
                            <li>
                                <div class="courses-image">
                                    <a href="#"><img src="{{ url('frontend/images/blog/small-tham/blog-01.jpg') }}" alt=""></a>
                                </div>
                                <div class="courses-nifo">
                                    <h5><a href="{{ route('courses.plab1') }}">Plab One </a></h5>
                                    <p>Duration : 4 Yr</p>
                                </div>
                            </li>
                            <li>
                                <div class="courses-image">
                                    <a href="{{ route('courses.plab1') }}"><img src="{{ url('frontend/images/blog/small-tham/blog-03.jpg') }}" alt=""></a>
                                </div>
                                <div class="courses-nifo">
                                    <h5><a href="#">MRCP ONE</a></h5>
                                    <p>Duration : 2 Yr</p>
                                </div>
                            </li>

                            <li>
                                <div class="courses-image">
                                    <a href="#"><img src="{{ url('frontend/images/blog/small-tham/blog-04.jpg') }}" alt=""></a>
                                </div>
                                <div class="courses-nifo">
                                    <h5><a href="#">FRCEM Primary</a></h5>
                                    <p>Duration : 2 Yr</p>
                                </div>
                            </li>

                            <li>
                                <div class="courses-image">
                                    <a href="#"><img src="{{ url('frontend/images/blog/small-tham/blog-0.jpg') }}" alt=""></a>
                                </div>
                                <div class="courses-nifo">
                                    <h5><a href="#">CPD Workshops</a></h5>
                                    <p>Duration : 2 Yr</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                --}}

                <div class="col-md-4 col-sm-6">
                    <div class="footer-block text-center">
                        <div class="subscribe_form mb-4">
                            <form action="">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Subscribe</button>
                                </div>
                            </form>
                        </div>
                        <h5>Follow Us</h5>
                        <ul class="footer-social-link">
                            <li><a target="_blank" href="https://www.facebook.com/PrepareMedicine"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a target="_blank" href="https://twitter.com/PrepareMedicine"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a target="_blank" href="https://www.instagram.com/prepare.medicine"><i class="zmdi zmdi-instagram"></i></a></li>
                            <li><a target="_blank" href="https://www.youtube.com/channel/UC-aACIkZHxVgtKs_edU96Xw"><i class="zmdi zmdi-youtube"></i></a></li>
                            <li><a target="_blank" href="{{route('contact-us')}}"><i class="zmdi zmdi-email"></i></a></li>
                            <!-- <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li> -->
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--// Footer Top Area -->

    <!-- Footer-bottom Area -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copy-right pt--10 pb--10 text-center text-white">
                        <p style='font-weight:normal'>Copyright &copy; <?php echo date('Y');?> <a href="#">PrepareMedicine</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div><!--// Footer-botton Area -->

</footer>
<!--// Footer Area -->


    <!-- only for showing alerts -->
    @if(session()->has('no_access_permission__'))
        <div class="modal fade" id="notice_modal__" tabindex="-1" role="dialog" aria-labelledby="noticeModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                <h5 class="col-12 modal-title text-center" id="noticeModalTitle" style="color:#fff">WARNING</h5>
                <button type="button" class="close" id="closeTheModal___now" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class='text-center'>Sorry, you are not allowed to access this page, please upgrade your subscription plan</p>
                <p class="text-center"><a href="{{ route('root_page') }}#our-subscription--plan" class='btn btn-sm'
                    style='background: #55BA5E; border: none; border-radius: 3px; width:100% !important'>UPGRADE</a></p>
              </div>
            </div>
          </div>
        </div>

        <script>
            let getButton_ = document.getElementById('closeTheModal___now');
            let getModal = document.getElementById('notice_modal__');

            getButton_.addEventListener('click', function(){
                getModal.classList.remove("show")
                getModal.style.display='none'
            })
        </script>
        @endif
    <!-- only for showing alerts  end here-->






    <!-- JS
    ============================================ -->

    <!-- jQuery JS -->
    <script src="{{ url('frontend/js/vendor/jquery-3.3.1.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ url('frontend/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
    <!-- Plugins JS -->
    <script src="{{ url('frontend/js/plugins.js') }}"></script>
    <!-- Ajax Mail -->
    <script src="{{ url('frontend/js/ajax-mail.js') }}"></script>

    <script src="{{ url('frontend/js/select2.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ url('frontend/js/main.js') }}"></script>

    {{--CDN LINKS--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    {{-- Custom Js --}}
    @yield('js')

    @stack('scripts')


        {{-- Copy Protector --}}
        <script tyle='text/javascript'>
            $(document).ready(function(){

                $('.select2-dropdown').select2();

                function disableselect(e) {
                    return false;
                }

                function reEnable() {
                    return true;
                }

                document.onselectstart = new Function("return false");

                if (window.sidebar) {
                    document.onmousedown = disableselect;
                    document.onclick = reEnable;
                }
            })
        </script>
    </body>
</html>
