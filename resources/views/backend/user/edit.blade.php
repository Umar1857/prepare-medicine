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

    <div class="alert alert-info" role="alert">Edit User</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('user.update', $user->id) }}" method="post">
        @method('PUT')
        @csrf

        <div class="form-group">
            <label><b>User First Name</b></label>
            <input id="title" type="text" name="first_name" placeholder="Enter First Name..." class="form-control" value="{{$user->f_name}}">
        </div>

        <div class="form-group">
            <label><b>User Second Name</b></label>
            <input id="title" type="text" name="second_name" placeholder="Enter Second Name..." class="form-control" value="{{$user->s_name}}">
        </div>

        <div class="form-group">
            <label><b>Email</b></label>
            <input type="text" name="email" placeholder="Enter Email..." class="form-control"  value="{{$user->email}}">
        </div>

        <div class="form-group">
            <label><b>School Name</b></label>
            <input id="title" type="text" name="school_name" placeholder="Enter School Name..." class="form-control" value="{{$user->school}}">
        </div>

        <div class="form-group">
            <label><b>Gender</b></label>
            <select class="form-control" name="gender">
                <option value="Male" {{$user->gender === 'Male' ? 'selected' : ''}}>Male</option>
                <option value="Female" {{$user->gender === 'Female' ? 'selected' : ''}}>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label><b>Country</b></label>
            <div>
                <select class="form-control" name="country">
                    <option>Select A Country</option>
                    @foreach($countries as $country)
                        <option value="{{$country->id}}" {{$user->country === $country->id ? 'selected' : ''}}>{{$country->country_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label><b>Role</b></label>
            <div>
                <select class="form-control" name="role">
                    <option>Select A Role</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{!empty($user->roles->pluck('id')[0]) && $user->roles->pluck('id')[0] === $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label><b>User Password</b></label>
            <input id="title" type="text" name="password" placeholder="Enter Password..." class="form-control">
        </div>

        <div class="form-group">
            <label><b>Confirm Password</b></label>
            <input id="title" type="text" name="password_confirmation" placeholder="Password Confirmation..." class="form-control">
        </div>

        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="UPDATE USER" style="float:right">
    </form>
@endsection
