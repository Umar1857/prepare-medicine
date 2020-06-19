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
            <h4 class="panel-title">Team Members</h4>
        </div>

        @if(auth()->user()->can('Create Team'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('team-members.create') }}" class="btn btn-sencodary">Add Team Member</a>
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
                        <th>Description</th>
                        <th>Profile</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($team_members as $team_member)
                        <tr>
                            <td >{{ $team_member->name }}</td>
                            <td >{{ $team_member->email }}</td>
                            <td ><?php echo str_limit($team_member->description, 50); ?></td>
                            <td ><img src="{{ asset('storage/team/'.$team_member->profile)}}" width="70px" height="70px"></td>
                            <td>
                                @if(auth()->user()->can('Edit Team'))
                                    <a href="{{ route('team-members.edit', $team_member->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Team'))

                                    <form method="post" class="delete-form" action="{{ route('team-members.destroy', $team_member->id) }}">
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
{{--            <span>{{ $team_members->render() }}</span>--}}
        </div>
    </div>


@endsection
