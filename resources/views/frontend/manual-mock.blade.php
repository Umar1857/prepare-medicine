@extends('frontend.master-frontend')
@section('js-css')
<style type="text/css">
    .existBTN{
        background-color: darkred !important;
        color: #fff !important;
        border: none !important;
        border-radius: 3px !important;
        padding: 3px 15px !important
    }
</style>
@endsection



@section('content')
<br>
{{--  data fetch from Database !!  --}}
<div class="container-fluid">
    <div class='page_banner_img_common'>
        <img src='/frontend/images/pages-banner.png' class='img-fluid'>
        <div class='overlay__'>
            <p>Manual Mock</p>
        </div>
    </div>

    <div class="container">

    <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">MANUAL MOCK</h2>

        <p class="text-center">Choose questions to be included by specialities for your own unique 180-MCQ exam .These questions are timed as well but are random in the sense that they have been selected from across the specialities just like in the real PLAB 1’
        </p>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>


    <div class="row my-4 my-md-5" style="padding-left: 30px; padding-right: 30px">
        @foreach ($expired_data as $key => $item)
            @if ($key%4 == '0')
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <a href="{{ url('q-bank/manual/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                            <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                            <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                        </a>
                    </div>
                @elseif($key%3 == '0')
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <a href="{{ url('q-bank/manual/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                            <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                            <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                        </a>
                    </div>
                @elseif($key%2 == '0')
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <a href="{{ url('q-bank/manual/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                            <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                            <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                        </a>
                    </div>
                @else
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <a href="{{ url('q-bank/manual/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                            <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                            <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                        </a>
                    </div>
            @endif
        @endforeach


    @if($exists_data != '0')
        @foreach ($continue_data as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                <a href="{{ url('q-bank/manual/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden">
                    <img src="{{ url('storage/photos/mock/random-mock/continue-mock.png') }}" alt="" style="width:35%;float:left;height:55px;">
                    <span style="margin-top:17px">{{ 'Continue Mock' }}</span>
                </a>
            </div>
        @endforeach
    @else
        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
            <button data-target="#exampleModalCenter" data-toggle="modal" type="button" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden">
                <img src="{{ url('storage/photos/mock/random-mock/new-mock.png') }}" alt="" style="width:35%;float:left;height:55px;">
                <span style="margin-top:17px">{{ 'New Mock' }}</span>
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ url('q-bank/manual') }}" method="get">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Choose Specialties</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs md-tabs" id="myTabMD" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab-md" data-toggle="tab" href="#home-md" role="tab" aria-controls="home-md" aria-selected="true">Specialities</a>
                                </li>
                            </ul>
                            <div class="tab-content card p-3" id="myTabContentMD">
                                <div class="tab-pane fade show active" id="home-md" role="tabpanel" aria-labelledby="home-tab-md">
                                    {{-- Categories --}}
                                    <input type="hidden" value="cat" name="type">
                                    @foreach ($cat as $item)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="cat{{ $item->id }}" value="{{ $item->id }}" name="search[]">
                                            <label class="custom-control-label" for="cat{{ $item->id }}">{{ $item->name }}</label>
                                        </div>
                                    @endforeach
                                    {{--<hr>
                                    <input type="radio" name="question_type" value="">Wrong Answered
                                    <input type="radio" name="question_type" value="">Right Answered
                                    <input type="radio" name="question_type" value="">Right Answered--}}

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div style="display: inline-block;float: right;text-align: right">
                                <button type="button" class="btn btn-danger bg-danger mr-2" data-dismiss="modal">Exit</button>
                                <input type="submit" value="Create New Mock" class="btn btn-success bg-success" style="float:right;border-radius: 4px">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
  </div> <!-- .row end here -->
</div>


<br>
@endsection
