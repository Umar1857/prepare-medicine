@extends('frontend.master-frontend')
@section('content')

    <div class="container-fluid" style="padding-left: 30px; padding-right: 30px">
        <div class='page_banner_img_common'>
            <img src='/frontend/images/pages-banner.png' class='img-fluid'>
            <div class='overlay__'>
                <p>Contact Us</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
            @include('msg.msg')

                <form action="{{ route('contact') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label><b>Title</b></label>
                        <input type="text" name="title" placeholder="Enter Suitable Title..." class="form-control" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label><b>Description</b></label>
                        <textarea name="description" class="form-control my-editor" rows="5" placeholder="Please Explain your Request...">{{old('description')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label><b>Preferred Email</b></label>
                        <input type="text" name="email" placeholder="Enter Your Preferred Email (if any)..." class="form-control" value="{{old('email')}}">
                    </div>
                    <br>
                    <input type="submit" class="btn btn_custom_style btn-primary" value="CONTACT US" style="float:right">
                </form>
            </div>
        </div>
    </div>
    <br><br>
@endsection
