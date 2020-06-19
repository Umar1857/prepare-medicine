@extends('frontend.master-frontend')
@section('content')

    <div class="container-fluid" style="padding-left: 30px; padding-right: 30px">
        <div class='page_banner_img_common'>
            <img src='/frontend/images/pages-banner.png' class='img-fluid'>
            <div class='overlay__'>
                <p>Create New Ticket</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('msg.msg')

                <form action="{{ route('ticket.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label><b>Ticket Title</b></label>
                        <input type="text" name="title" placeholder="Enter Suitable Title..." class="form-control" value="{{old('title')}}">
                    </div>

                    <div class="form-group">
                        <label><b>Ticket Description</b></label>
                        <textarea name="description" class="form-control my-editor" rows="5" placeholder="Please Explain your Request...">{{old('description')}}</textarea>
                    </div>
                    <br>
                    <input type="submit" class="btn btn_custom_style btn-primary" value="CREATE TICKET" style="float:right">
                </form>
            </div>
        </div>
    </div>
    <br><br>
@endsection
