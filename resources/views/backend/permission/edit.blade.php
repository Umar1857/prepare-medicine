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

    <div class="alert alert-info" role="alert">Edit Permission</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('permission.update', $permission->id) }}" method="POST">
        @method('PUT')
        @csrf
        <label><b>Permission Name</b></label>
        <input id="title" type="text" name="name" placeholder="Enter Permission..." class="form-control" value="{{$permission->name}}">
        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="UPDATE PERMISSION" style="float:right">
    </form>
@endsection
