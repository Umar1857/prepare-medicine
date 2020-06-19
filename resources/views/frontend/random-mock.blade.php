@extends('frontend.master-frontend')
@section('content')
<br>
    {{--  data fetch from Database !!  --}}

    <div class="container-fluid"> 
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Random Mock </p>
            </div>
        </div>
        <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">RANDOM MOCKS</h2>
        <div class="container">
            <p style="text-center">
                Your opportunity to test yourself on randomly generated full simulation of the GMC PlAB-1 Exam, which timed 3:00 hours for 180 MCQs.
            <br>
                These are timed, random mock exams using a selection of questions from our extensive Q Bank. You may find you have answered a question previously, but it is likely that many are new to you. This gives you the chance to time yourself to exam conditions for the PLAB 1
            </p>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
        
            @endif
        </div>
       <div class="row my-4 my-md-5" style="padding-left: 35px; padding-right: 35px">
            @foreach ($expired_data as $key => $item)
                @if ($key%4 == '0')
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <a href="{{ url('q-bank/random/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                                <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                                <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                            </a>
                        </div>
                    @elseif($key%3 == '0')
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <a href="{{ url('q-bank/random/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                                <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                                <span style="margin-top:17px">MOCk {{ $key+1 }}</span>
                            </a>
                        </div>
                    @elseif($key%2 == '0')
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <a href="{{ url('q-bank/random/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                                <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                                <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                            </a>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                            <a href="{{ url('q-bank/random/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden;background-color: #2C3069">
                                <img src="{{ url('storage/photos/mock/random-mock/general-icons.png') }}" alt="" style="width:35%;float:left;height:55px;">
                                <span style="margin-top:17px">MOCK {{ $key+1 }}</span>
                            </a>
                        </div>
                @endif
            @endforeach
            @if($exists_data != '0')
                @foreach ($continue_data as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <a href="{{ url('q-bank/random/exam/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden">
                            <img src="{{ url('storage/photos/mock/random-mock/continue-mock.png') }}" alt="" style="width:35%;float:left;height:55px;">
                            <span style="margin-top:17px">{{ 'Continue Mock' }}</span>
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                    <a href="{{ url('q-bank/random') }}" class="btn btn-spinner col-12 p-0" style="padding:0;border-radius:10px;overflow:hidden">
                        <img src="{{ url('storage/photos/mock/random-mock/new-mock.png') }}" alt="" style="width:35%;float:left;height:55px;">
                        <span style="margin-top:17px">{{ 'New Mock' }}</span>
                    </a>
                </div>
            @endif
        </div>
     </div>
 
    <br>

@endsection
