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
            <h4 class="panel-title">Permissions</h4>
        </div>

        @if(auth()->user()->can('Create Permission'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('permission.create') }}" class="btn btn-sencodary">Add Permission</a>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>Permission Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td >{{ $permission->name }}</td>
                            <td>
                                @if(auth()->user()->can('Edit Permission'))
                                    <a href="{{ route('permission.edit', $permission->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Permission'))
                                    <form method="post" class="delete-form" action="{{ route('permission.destroy', $permission->id) }}">
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

                <span style="float:right"> {{ $permissions->links() }}</span>
            </div>
            {{--            <span>{{ $permissions->render() }}</span>--}}

        </div>
    </div>


@endsection
