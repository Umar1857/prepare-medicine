@extends('frontend.master-frontend')
@section('js-css')
    <style>
        /***********************************************/
        /***************** Accordion ********************/
        /***********************************************/
        @import url('https://fonts.googleapis.com/css?family=Tajawal');
        @import url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

        section{
            padding: 30px 0;
        }

        #accordion-style-1 h1,
        #accordion-style-1 a{
            color:#63BA52;
        }
        #accordion-style-1 .btn-link {
            font-weight: 400;
            color: #63BA52;
            background-color: transparent;
            text-decoration: none !important;
            font-size: 16px;
            font-weight: bold;
            padding-left: 25px;
        }

        #accordion-style-1 .card-body {
            border-top: 2px solid #63BA52;
        }

        #accordion-style-1 .card-header .btn.collapsed .fa.main{
            display:none;
        }

        #accordion-style-1 .card-header .btn .fa.main{
            background: #F7F7F7;
            margin-left: 26px;
            color: #63BA52;
            width: 15px;
            height: 20px;
            position: absolute;
            left: -1px;
            top: 10px;
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
            display:block;
        }

        button {
          white-space:normal !important;
          word-wrap:break-word;
        }
    </style>
@endsection
@section('content')
<br>
    
    {{-- <div class="container-fluid"> --}}
        {{--  data fetch from Database !!  --}}
        {{-- {!! $data !!} --}}
    {{-- </div> --}}
        <div class="container-fluid  bg-gray" style="padding-left: 20px; padding-right: 20px" id="accordion-style-1">
            <div class='page_banner_img_common'>
                <img src='/frontend/images/pages-banner.png' class='img-fluid'>
                <div class='overlay__'>
                    <p>FAQ</p>
                </div>
            </div>
            
            
                <div class="row mb-5">
                    <div class="container">
                    
                        <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">Frequently Asked Questions</h2>

                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> What do I have to pay to register?
                                </button>
                              </h5>
                                </div>
    
                                <div id="collapseOne" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Registering with PrepareMedicine is free and there are no obligations. You can set up your account and have access to 15-20 free questions
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col2" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i>Why should I bother subscribing? Aren’t there others out there?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col2" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Yes there are, but we firmly believe what we offer is more tailored to your needs. If you subscribe, you have
                                        access to our courses, high yield recall questions and our revision notes
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col3" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> So how does the subscription system work with PrepareMedicine?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col3" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        We keep it simple. You subscribe to your chosen plan - 1, 3 or 6-months and then you get access to all of our
                                        current and upcoming content. There is a one-time payment for every subscription period, and we remind you
                                        when it is due to expire.
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col4" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i>Great! So how do I pay?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col4" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        You can purchase your subscription by credit card (Visa, Mastercard or Delta) or debit card (Maestro) or
                                        through your PayPal account. (Please note: Not all currencies can be used for all methods of payment.) If you
                                        download our <b>PrepareMedicine</b> app, you can buy a subscription from the iTunes Store or Google Play; however,
                                        this option is more expensive. Why? Read on
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col5" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i>Why are subscriptions purchased via mobile apps more expensive than those found directly on www.PrepareMedicine.com?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col5" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        The reason for the difference in price is relatively simple: buying subscriptions on www.PrepareMedicine.com
                                        does not include additional app store fees. Unfortunately, this is something we cannot change.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col6" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i>Once I have done the questions, can I reset and start again?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col6" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Yes, all of our subscription plans allow you to reset as many times as you want.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#col7" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> Can you give me a guarantee that by studying with Prepare Medicine I will pass all my PLAB exams and any others I study with your plan?
                                </button>
                              </h5>
                                </div>
    
                                <div id="col7" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        We absolutely guarantee the quality of our product. If you work hard and study smart with Prepare Medicine,
                                        and if you use the support we offer through our community forums, you will stand a much better chance than
                                        going it alone. The short and long revision notes will help you maximise recall and conceptual clarity and
                                        significantly increase your chances at achieving high scores. 
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co18" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> Can you give me a guarantee that by studying with Prepare Medicine I will pass all my PLAB exams and any others I study with your plan?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co18" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        We absolutely guarantee the quality of our product. If you work hard and study smart with Prepare Medicine,
                                        and if you use the support we offer through our community forums, you will stand a much better chance than
                                        going it alone. The short and long revision notes will help you maximise recall and conceptual clarity and
                                        significantly increase your chances at achieving high scores. 
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co19" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> What about refunds? Do you offer them if I decide I don’ like your service?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co19" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Once you have registered a subscription, we will only be able to refund it in certain circumstances. If our service
                                        is found to be ‘faulty’ in some way then you are entitled to a full refund. If however, you have used it for three
                                        months of a six-month subscription then decide you no longer wish to continue, or your circumstances change, we
                                        will offer a pro-rated refund minus costs. If during your subscription there is something you find ‘clunky’ or
                                        awkward, we would rather you tell us so we can address any web-related problems than immediately cancel. 
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co20" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> How similar are your questions to the Professional and Linguistic Assessments Board (PLAB) part 1 exam?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co20" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Very! They are worded in exactly the same way as the PLAB part 1 questions.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co21" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> How do I know your answers to the questions are correct?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co21" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        A We have a team of professionals working on developing these scenarios and answers. Our answers include
                                        detailed rationales taken from up to date UK guidelines. If you think we have missed some latest guidance – let us
                                        know.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co22" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> Will you be adding more questions or courses?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co22" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Yes, we are continuously adding questions to our question bank.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#co23" aria-expanded="true" aria-controls="collapseOne">
                                  <i class="fa fa-angle-double-down main"></i><i class="fa fa-angle-double-right mr-3"></i> My card payment has been declined. What next?
                                </button>
                              </h5>
                                </div>
    
                                <div id="co23" class="collapse hide fade" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        Try again or another card. Remember we accept credit card (Visa, Mastercard or Delta) or debit card (Maestro)
                                        or through your PayPal account. If your card payment has been declined, please contact your bank first to find out
                                        the reason or use an alternative payment method as above.
                                    </div>
                                </div>
                            </div>

                        </div>
                    
                    </div>

                </div>
        </div>
    
@endsection
