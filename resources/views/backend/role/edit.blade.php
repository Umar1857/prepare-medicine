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

    <div class="alert alert-info" role="alert">Edit Role</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('role.update', $role->id) }}" method="post">
        @method('PUT')
        @csrf
        <label><b>Role Name</b></label>
        <input id="title" type="text" name="name" placeholder="Enter Role..." class="form-control" value="{{$role->name}}">
        <br>

        <div class="form-group">
            <div>
                <h4>Permissions</h4>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <input type="checkbox" name="select-all" class="select-all"> Select All Permissions
                </div>
            </div>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <input type="checkbox" name="permissions[]" value="{{$permission->name}}" {{in_array( $permission->name, $role->permissions->pluck('name')->toArray()) ? 'checked' : ''}}> {{$permission->name}}
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="UPDATE ROLE" style="float:right">
    </form>
@endsection
