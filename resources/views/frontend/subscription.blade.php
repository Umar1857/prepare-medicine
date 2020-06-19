@extends('frontend.master-frontend')
@section('js-css')

    <style>
        .page-heading{
            margin-bottom: 70px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .page-sub-heading{
            text-align: center;
            font-weight: bold;
            border: 2px solid #ddd;
            background: #2C3069;
            padding: 15px 0;
            margin-bottom: 20px;
            color: #fff;
        }

        .bg_color{
            background: rgb(119,119,119);
            background: radial-gradient(circle, rgba(119,119,119,1) 8%, rgba(153,153,153,1) 27%, rgba(221,221,221,1) 60%, rgba(153,153,153,1) 94%);
            padding: 35px 0;
        }
        .bg_color .single_plan .card{
            background: transparent !important;
        }
        .single_plan{
            margin-bottom: 100px;
            text-align: center !important;
        }
        .single_plan .card{
            border: none;
        }
        .single_plan .card .icon{
            padding: 0px;
            text-align: center;
            position: relative;
        }

        .single_plan .card .icon img{

        }
        .single_plan .card .icon p{
            position: absolute;
            right: 12%;
            bottom: 18%;
        }

        .single_plan .subscribe_button_one{
            background: rgb(254,199,61);
            background: -moz-linear-gradient(90deg, rgba(254,199,61,1) 15%, rgba(251,167,53,1) 45%, rgba(221,221,221,1) 92%);
            background: -webkit-linear-gradient(90deg, rgba(254,199,61,1) 15%, rgba(251,167,53,1) 45%, rgba(221,221,221,1) 92%);
            background: linear-gradient(90deg, rgba(254,199,61,1) 15%, rgba(251,167,53,1) 45%, rgba(221,221,221,1) 92%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#fec73d",endColorstr="#dddddd",GradientType=1);
        }
        .single_plan .subscribe_button_two{
            background: rgb(57,193,81);
            background: -moz-linear-gradient(90deg, rgba(57,193,81,1) 15%, rgba(39,186,84,1) 45%, rgba(221,221,221,1) 92%);
            background: -webkit-linear-gradient(90deg, rgba(57,193,81,1) 15%, rgba(39,186,84,1) 45%, rgba(221,221,221,1) 92%);
            background: linear-gradient(90deg, rgba(57,193,81,1) 15%, rgba(39,186,84,1) 45%, rgba(221,221,221,1) 92%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#39c151",endColorstr="#dddddd",GradientType=1);
        }
        .single_plan .subscribe_button_three{
            background: rgb(0,145,231);
            background: -moz-linear-gradient(90deg, rgba(0,145,231,1) 15%, rgba(221,221,221,1) 45%, rgba(0,184,234,1) 92%);
            background: -webkit-linear-gradient(90deg, rgba(0,145,231,1) 15%, rgba(221,221,221,1) 45%, rgba(0,184,234,1) 92%);
            background: linear-gradient(90deg, rgba(0,145,231,1) 15%, rgba(221,221,221,1) 45%, rgba(0,184,234,1) 92%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#0091e7",endColorstr="#00b8ea",GradientType=1);
        }

        .single_plan .subscribe_button{
            border-radius: 3px !important;
            font-weight: normal;
            border: none;
            padding: 3px 5px
        }
        .single_plan .subscribe_button:hover{
            box-shadow: 1px 4px 7px 2px #777;
            transform: scale(1.1);
            transition: .5s
        }
        .single_plan .extra_btn{
            right: 14%;
        }

        .upgrade_button{
            width: 100%
        }
    </style>

@endsection


@section('content')
    <br>

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>My Subscription</p>
            </div>
        </div>
        <div class="container">
            <h5 class="page-sub-heading">Your Current Plan</h5>
            <div class="row my-4 my-md-5 justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    @include('msg.msg')
                </div>
                <div class="col-md-2"></div>
            </div>

            @if(Auth::user()->role == 1)
                <div class="row my-4 my-md-5 justify-content-center">
                    <div class='col-md-4'></div>
                    <div class="col-md-4">
                        <h6 style="text-align: center; display: block;">{{ 'You have no Subscription Plan' }}</h6>
                        <div style="margin-top: 25px" class="text-center"><a href="{{ route('root_page') }}#most_popular_courses" class="btn btn-success btn-sm upgrade_button">UPGRADE PLAN NOW</a></div>
                    </div>
                    <div class='col-md-4'></div>
                </div>
            @endif


            @if(Auth::user()->role >= 2)
                <div class="row my-4 my-md-5 justify-content-center">

                    <div class="col-md-8 col-sm-12">
                        <div class="plna_status">
                            <h6 class="text-center mb-4"><b>PLAN STATUS</b></h6>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Your Subscription Plan</th>
                                    <td>
                                        @if(Auth::user()->role == 2)
                                            {{ 'Trial' }}
                                        @elseif(Auth::user()->role == 3)
                                            {{ 'Refugees Doctors' }}
                                        @elseif(Auth::user()->role == 5)
                                            {{ 'Basic' }}
                                        @elseif(Auth::user()->role == 6)
                                            {{ 'Standard' }}
                                        @elseif(Auth::user()->role == 7)
                                            {{ 'Advance' }}
                                        @elseif(Auth::user()->role == 8)
                                            {{ 'Professional' }}
                                        @else
                                            {{ 'Something wrong' }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th>
                                        @if(Auth::user()->expeir_date < date('Y-m-d'))
                                            <span style="color: red">{{ 'Expired' }}</span>
                                        @else
                                            <span style="color: green">{{ 'Active' }}</span>
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>Expired Date</th>
                                    <th>{{ date('d F Y', strtotime(Auth::user()->expeir_date)) }}</th>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <a class="upgrade_button btn btn-sm" href="{{ route('root_page') }}#most_popular_courses">UPGRADE PLAN</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if(Auth::user()->role == 2)
                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Free Trial</h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>24-Hour Access
                                        <li>20 Q-Bank</li>
                                        <li>30 Different Specialties</li>
                                        <li>Mock Exam</li>
                                        <li>Progress Review</li>
                                        <li>Option to upgrade</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>00.00</strong>
                                    </div>
                                <!-- <div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '6']) }}" class="botton-border">BUY NOW</a> -->
                                </div>
                            </div>
                        </div> <!-- .single_plan end here -->

                    @elseif(Auth::user()->role == 3)
                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Refugee Doctors Free</h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>3 Months Access
                                        <li>2000 Q-Bank</li>
                                        <li>30 Different Specialties</li>
                                        <li>Unlimited Random Mocks</li>
                                        <li>Unlimited Manual Mocks</li>
                                        <li>Progress Review</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>00.00</strong>
                                    </div>
                                <!-- <div class="price-value">
								<strong><sup>£</sup>00.00</strong>
							</div>
							<a href="{{ route('checkOutForm.stripe', ['Plab One', '7']) }}" class="botton-border">BUY NOW</a> -->
                                </div>
                            </div>
                        </div> <!-- .single_plan end here -->

                    @elseif(Auth::user()->role == 5)

                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Basic</h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>1 Months Access
                                        <li>2000 Q-Bank</li>
                                        <li>30 Different Specialties</li>
                                        <li>Unlimited Random Mocks</li>
                                        <li>Unlimited Manual Mocks</li>
                                        <li>Progress Review</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>9.99</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif(Auth::user()->role == 6)
                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Standard </h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>3 Months Access</li>
                                        <li>2000 Q-Bank</li>
                                        <li>30 Different Specialties</li>
                                        <li>Unlimited Random Mocks</li>
                                        <li>Unlimited Manual Mocks</li>
                                        <li>Recall Exams 2020-2017</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>14.99</strong>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .single_plan end here -->

                    @elseif(Auth::user()->role == 7)
                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Advance</h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>6 Months Access</li>
                                        <li>4000 Q-Bank</li>
                                        <li>30 Different Specialties</li>
                                        <li>Unlimited Mocks</li>
                                        <li>Recall Exam 2020-2018</li>
                                        <li>Access to Notes Bank</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>24.99</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- .single_plan end here -->
                    @elseif(Auth::user()->role == 8)
                        <div class="col-md-4 col-sm-12 single_plan">
                            <div class="card">
                                <div class="price-header">
                                    <h3>Professional</h3>
                                </div>
                                <div class="price-content">
                                    <ul>
                                        <li>Advance Plus</li>
                                        <li>Access to Image Bank</li>
                                        <li>Access to Video Bank</li>
                                        <li>Access to Webinar</li>
                                        <li>Access to Smart Mock</li>
                                        <li>One to One Session</li>
                                    </ul>
                                    <div class="price-value">
                                        <strong><sup>£</sup>49.99</strong>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .single_plan end here -->
                    @endif
                </div> <!-- .row end here -->
            @endif
        </div>
        <br>
@endsection
