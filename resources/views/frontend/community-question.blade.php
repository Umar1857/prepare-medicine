@extends('frontend.master-frontend')
@section('content')
<br>

{{--  data fetch from Database !!  --}}

    <div class="container-fluid" style="padding-left: 20px; padding-right: 20px">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Plab Community <br> Questions</p>
            </div>
        </div>

        <div class="container">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">
                Plab Community Questions
            </h2>
            
            <p class="text-center">
                Our revision bank is something that we hope will help you through not only the PLAB exam process, but also through other studies you will undertake and with your CPD. The revision notes are bite-size pieces of information that are taken from sources we have researched such as NCE Guidance, SIGN guidance and a whole range of reference materials including research and Cochrane reviews. It is divided into the same categories as the question bank and each note has a ‘flash card’ and a more detailed content.
                We recommend you review the revision notes before entering the question bank, and then afterwards to look at some of the details around the questions or any areas of uncertainty you may have. Remember the words of Helen Keller: We can do anything we want to do if we stick to it long enough. Revision helps us do that.

            </p>
        </div>

        <div class="row my-4 my-md-5" style="padding-left: 45px; padding-right: 45px">
            @foreach ($data as $key=>$item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                    <a href="{{ url('q-bank/user-category/question/'.$item->id) }}" class="btn btn-spinner col-12 p-0" style="background:{{ $item->cat_color }};padding:0;border-radius:10px;overflow:hidden">
                        <img src="{{ url('storage/photos/'.$item->cat_img) }}" alt="" style="width:35%;float:left;height:55px;">
                        <span style="margin-top:17px">{{ $item->name }}</span>
                    </a>
                </div>
            @endforeach
        </div>
  </div>
<br>
@endsection
