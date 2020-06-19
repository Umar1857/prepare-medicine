<!Doctype html>
<html class="no-js" lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home || Prepare Medicine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/favicon.ico') }}">

    {{--CDN LINKS--}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9">

    <!-- CSS
    ========================= -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/bootstrap.min.css') }}">

    <!-- Fonts CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/material-design-iconic-font.min.css') }}">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/plugins.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ url('frontend/css/style.css') }}">

    <!-- Modernizer JS -->
    <script src="{{ url('frontend/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <style>
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

    @if(Request::is('/'))
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/subscription-design.css') }}">
    @endif

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
    <style>
        /*Way Two*/
        .protector___protect {
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer */
            -khtml-user-select: none; /* KHTML browsers (e.g. Konqueror) */
            -webkit-user-select: none; /* Chrome, Safari, and Opera */
            -webkit-touch-callout: none; /* Disable Android and iOS callouts*/
        }

    </style>
    {{-- Copy Protector CSS end from here --}}
</head>

{{-- Copy Protector JS --}}
<body oncontextmenu="return false"  class="protector___protect scroll">


<!-- Main Wrapper Start -->
<div class="main-wrapper">

<header class="header-area fixed-top">
        <!-- header-top-area -->
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">

                        <!-- top-contact-info -->
                        <div class="top-contact-info">
                            <ul>
                                <!-- <li><a href="#"><i class="zmdi zmdi-phone"></i> +98 558 547 589</a></li> -->
{{--                                <li><a href="#"><i class="zmdi zmdi-email"></i>info@preparemedicine.com</a></li>--}}
                            </ul>
                        </div><!--// top-contact-info -->

                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="top-info-right">

                            <!-- top-social -->
                            <div class="top-social">
                                <ul>
                                    <li><a href="https://www.facebook.com/PrepareMedicine"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="https://twitter.com/PrepareMedicine"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/prepare.medicine"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UC-aACIkZHxVgtKs_edU96Xw"><i class="zmdi zmdi-youtube"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-email"></i></a></li>
                                    <!-- <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li> -->
                                </ul>
                            </div><!--// top-social -->

                            <!-- login-and-register -->
                            <div class="login-and-register">
                                @guest
                                    <ul>
{{--                                        <li><a href="{{ url('login') }}">Login</a></li>--}}
                                    <!--<li><a href="{{ url('register') }}">Register</a></li>-->
                                    </ul>
                                @endguest
                                @if (Auth::user())
                                    <ul>
                                        <li class="nav-item dropdown" style="background: #fff;">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out" aria-hidden="true"></i>{{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                @endif
                            </div><!--// login-and-register -->

                        </div>
                    </div>
                </div>
            </div>
        </div><!--// header-top-area -->

        <div class="header-bottom-area header-sticky">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-5 col-6">

                        <!-- logo-area -->
                        <div class="logo-area">
                            <a href="{{ url('/') }}"><img src="{{ url('frontend/images/logo/logo-3.png') }}" alt=""></a>
                        </div><!--// logo-area -->

                    </div>

                    <div class="col-lg-9 col-md-7 col-6">

                        <div class="header-bottom-right">
                            <!-- main-menu -->
                            <div class="main-menu">
                                <nav class="main-navigation">
                                    <ul>
                                        <li><a href="/login">Login</a></li>
                                        <li><a href="/register">Sign Up</a></li>
                                    </ul>
                                </nav>
                            </div><!--// main-menu -->
                        </div>
                    </div>
                    <div class="mobile-menu d-block d-lg-none"></div>

                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="card form-wrapper">

                <div class="card-header text-center">
                    <h3>Update Password</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{$token}}">

                        <div class="form-group">
                            <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="text-md-right">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Reset Password') }}
                                </button>
                        </div>
                    </form>
                </div>
                {{--            </div>--}}
            </div>
        </div>
    </div>

</div>
<!-- Main Wrapper End -->


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
<!-- Main JS -->
<script src="{{ url('frontend/js/main.js') }}"></script>
{{-- Custom Js --}}
@yield('js')

@stack('scripts')


{{-- Copy Protector --}}
<script tyle='text/javascript'>
    $(document).ready(function(){
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
