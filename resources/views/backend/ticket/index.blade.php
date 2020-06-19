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
            <h4 class="panel-title">Contacts</h4>
        </div>

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Submitted At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td >{{ $ticket->title }}</td>
                            <td ><?php echo str_limit($ticket->description, 50); ?></td>
                            <td >{{ $ticket->user->email }}</td>
                            <td >{{ $ticket->status ? 'Resolved' : 'Pending' }}</td>
                            <td >{{ date('Y-m-d', strtotime($ticket->created_at)) }}</td>
                            <td>
                                @if(auth()->user()->can('View Ticket'))
                                    <a href="{{ route('view-ticket', $ticket->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-eye edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Edit Ticket'))
                                    @if($ticket->status)
                                        <a href="{{ route('ticket-status', $ticket->id) }}" style="background-color: red; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-remove edit"></i></a>
                                    @else
                                        <a href="{{ route('ticket-status', $ticket->id) }}" style="background-color: #1c7430; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-check edit"></i></a>
                                    @endif
                                @endif

                                {{--@if(auth()->user()->can('Delete Ticket'))
                                    <form method="post" class="delete-form" action="{{ route('contact.destroy', $ticket->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" style="background-color: red; color: #fff; border: none;" class="btn btn-sm delete-submit-btn"><i class="fa fa-remove"></i></button>
                                    </form>
                                @endif--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <span>{{ $tickets->render() }}</span>
        </div>
    </div>
@endsection
