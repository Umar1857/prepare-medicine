@extends('frontend.master-frontend')
@section('content')
<br>


{{--  data fetch from Database !!  --}}

    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Plab Community Add Question</p>
            </div>
        </div>
        
        <div class="container">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">
            Add Questions to Plab Community
            </h2>
        
        
            <p class="text-center">
                This is your chance to share ideas for questions or indeed questions you may remember from sitting the exam. If you click on the link below, it will open up a text section for question, answer selection and rationale / explanation and hints. Even if it is a basic draft or a partial question, please share and our question developers will build it up into a full question.
            </p>
        </div>
        {{-- <div class="row my-4 my-md-5" style="padding-left: 45px; padding-right: 45px">
            <div style="margin-right:5px;">
                <a href="{{ url('user/question/single/'.Auth::user()->id) }}" class="btn btn-spinner col-12 bg-info">View Single Question</a>
            </div>
            <div style="margin-left:5px;">
                <a href="{{ url('user/question/multi/'.Auth::user()->id) }}" class="btn btn-spinner col-12 bg-info">View Multichoice Question</a>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ url('user/question/add/single') }}" class="btn btn-spinner col-12">Add Question</a>
            </div>
            <div class="col-sm-6">
                <a href="{{ url('user/question/add/multi') }}" class="btn btn-spinner col-12">Add Multichoice Question</a>
            </div>
        </div> --}}
        <div class="row my-4 my-md-5" style="padding-left: 45px; padding-right: 45px">
                    <a href="{{ url('user/question/add/single') }}" class="btn btn-success" style="
                        text-transform: uppercase;
                        margin:0 auto;display:block;width:100%;
                        max-width: 400px;">Add Question</a>
            </div>
    </div>



<br>
@endsection
