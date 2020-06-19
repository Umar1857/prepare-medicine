@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


@endsection

@section('content')

    <div class="alert alert-info" role="alert">Create New Role</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label><b>Role Name</b></label>
        <input id="title" type="text" name="name" placeholder="Enter Role..." class="form-control">
        <br>

        <div class="form-group">
            <div>
                <h4>Permissions</h4>
            </div>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <input type="checkbox" name="permissions[]" value="{{$permission->name}}"> {{$permission->name}}
                    </div>
                @endforeach
            </div>
        </div>
        <input type="submit" class="btn btn_custom_style btn-primary" value="CREATE ROLE" style="float:right">
    </form>

@endsection
