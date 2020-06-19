@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <style type="text/css">
        .btn_custom_style{
            background-color: #ddd;
            color: #000
        }
        .current img{
            width: 200px
        }
    </style>
@endsection

@section('content')

    <div class="alert alert-info" role="alert">Contact Details</div>
    @include('msg.msg')

    <div>
        <div class="form-group">
            <label><b>User Name</b></label>
            <input type="text" name="name" class="form-control"  value="{{$contact->user->f_name.' '.$contact->user->s_name}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Email</b></label>
            <input type="text" name="email" class="form-control"  value="{{$contact->email}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Title</b></label>
            <input id="title" type="text" name="title" class="form-control" value="{{$contact->title}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Description</b></label>
            <textarea name="description" class="form-control" rows="7" readonly>{{$contact->description}}</textarea>
        </div>

        <div class="form-group">
            <label><b>Status</b></label>
            <input id="title" type="text" name="status" class="form-control" value="{{$contact->status ? 'We have Replied to Sender on this.' : 'Reply is Pending on this.'}}" readonly>
        </div>
    </div>
@endsection
