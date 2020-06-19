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
    <br>

    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Events</h4>
        </div>

        @if(auth()->user()->can('Create Course'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('events.create') }}" class="btn btn-sencodary">Add Event</a>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Starting From</th>
                        <th>Ending At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($events as $key=>$item)
                        <tr>
                            <td scope="row">{{ $key+1 }}</td>
                            <td >{{ $item->title }}</td>
                            <td> {{ date('m-d-Y', strtotime($item->start))}}</td>
                            <td> {{ date('m-d-Y', strtotime($item->end))}}</td>
                            <td>
                                @if(auth()->user()->can('View Event'))
                                    <a href="{{ route('events.show', $item->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-eye edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Edit Event'))
                                    <a href="{{ route('events.edit', $item->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Event'))
                                    <form method="post" class="delete-form" action="{{ route('events.destroy', $item->id) }}">
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
            <span>{{ $events->render() }}</span>
        </div>
    </div>


@endsection
