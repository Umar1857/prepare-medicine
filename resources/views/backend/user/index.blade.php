@extends('backend.master-backend')
@section('js-css')
    <style>
        .panel-white{
            background: white;
            padding: 10px;
        }
        .btn-left{
            float: right;
        }
        .delete{
            color: red;
            margin-left: 5px;
        }
        .edit , .delete{
            font-size: 25px;
        }
        .edit {
            cursor: pointer;
        }


        .fa-remove{
            color: #fff !important
        }

    </style>
@endsection
@section('content')

    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Users</h4>
        </div>

        @if(auth()->user()->can('Create User'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('user.create') }}" class="btn btn-sencodary">Add New User</a>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>School</th>
                        <th>Country</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td >{{ $user->f_name.' '.$user->s_name }}</td>
                            <td >{{ $user->email }}</td>
                            <td >{{ $user->school }}</td>
                            <td >{{ \App\country::find($user->country)->country_name }}</td>
                            <td >{{ !empty($user->roles->pluck('name')[0]) ? $user->roles->pluck('name')[0] : ''}}</td>
                            <td>
                                @if(auth()->user()->can('Edit User'))
                                    <a href="{{ route('user.edit', $user->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete User'))
                                    <form method="post" class="delete-form" action="{{ route('user.destroy', $user->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" style="background-color: red; color: #fff; border: none;" class="btn btn-sm delete-submit-btn"><i class="fa fa-remove"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <span>{{ $users->render() }}</span>--}}
        </div>
    </div>


@endsection
