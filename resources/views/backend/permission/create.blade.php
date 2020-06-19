@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


@endsection

@section('content')

    <div class="alert alert-info" role="alert">Create New Permission</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('permission.store') }}" method="POST">
        @csrf
        <label><b>Permission Name</b></label>
        <input id="title" type="text" name="name" placeholder="Enter Permission..." class="form-control">
        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="CREATE PERMISSION" style="float:right">
    </form>

@endsection
