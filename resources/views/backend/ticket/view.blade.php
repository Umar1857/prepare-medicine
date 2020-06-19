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

    <div class="alert alert-info" role="alert">Ticket Details</div>
    @include('msg.msg')

    <div>
        <div class="form-group">
            <label><b>User Name</b></label>
            <input type="text" name="name" class="form-control"  value="{{$ticket->user->f_name.' '.$ticket->user->s_name}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Email</b></label>
            <input type="text" name="email" class="form-control"  value="{{$ticket->user->email}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Title</b></label>
            <input id="title" type="text" name="title" class="form-control" value="{{$ticket->title}}" readonly>
        </div>

        <div class="form-group">
            <label><b>Description</b></label>
            <textarea name="description" class="form-control" rows="7" readonly>{{$ticket->description}}</textarea>
        </div>

        <div class="form-group">
            <label><b>Status</b></label>
            <input id="title" type="text" name="status" class="form-control" value="{{$ticket->status ? 'Ticket has been Resolved!' : 'Ticket is Pending!'}}" readonly>
        </div>
    </div>
@endsection
