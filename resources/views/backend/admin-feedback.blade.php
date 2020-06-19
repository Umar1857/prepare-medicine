@extends('backend.master-backend')
@section('js-css')

    <style>
        .user-name-hidden{
            color:red;
            display: ruby;
        }
        .user-name-show{
            color:#63BA52;
            display: ruby;
        }
        .user-feedback{
            margin-left: 25px;
        }
        .edit-btn{
            color: green;
        }
        .panel-warning{
            background: #fff;
            padding: 10px
        }
    </style>

@endsection
@section('content')
<br>

    {{--  data fetch from Database !!  --}}
    <div class="panel panel-warning">
        <div class="panel-body">
            <div class="container">
                <div class="row">
                    <div class="well">
                        <h2 class="text-center mb-5">Feedback</h2>
                        <br>
                        @foreach ($data as $item)
                            @if ($item->status == '1')
                                <div class="list-group">
                                    <div class="col-md-12">
                                        <h4 class="list-group-item-heading  user-name-show">
                                            {{ $item->user_name }}
                                            @if ($item->status == '1')
                                                <a href="{{ url('admin/feedback/hide/'.$item->id ) }}"><i class="fa fa-eye-slash edit-btn"></i></a>
                                            @elseif($item->status == '2')
                                                <a href="{{ url('admin/feedback/show/'.$item->id ) }}"><i class="fa fa-eye edit-btn"></i></a>
                                            @endif
                                            <a href="{{ url('admin/feedback/drop/'.$item->id) }}"><i class="fa fa-remove"></i></a>
                                        </h4>
                                        <p class="list-group-item-text user-feedback"> {{ $item->feedback }} </p>
                                    </div>
                                </div>
                                <br>
                            @else
                                <div class="list-group">
                                    <div class="col-md-12">
                                        <h4 class="list-group-item-heading  user-name-hidden">
                                            {{ $item->user_name }}
                                            @if ($item->status == '1')
                                                <a href="{{ url('admin/feedback/hide/'.$item->id ) }}"><i class="fa fa-eye-slash edit-btn"></i></a>
                                            @elseif($item->status == '2')
                                                <a href="{{ url('admin/feedback/show/'.$item->id ) }}"><i class="fa fa-eye edit-btn"></i></a>
                                            @endif
                                            <a href="{{ url('admin/feedback/drop/'.$item->id) }}"><i class="fa fa-remove"></i></a>
                                        </h4>
                                        <p class="list-group-item-text user-feedback"> {{ $item->feedback }} </p>
                                    </div>
                                </div>
                                <br>
                            @endif

                        @endforeach
                    </div>
                </div>
                <br>
                <span>
                    {{ $data->links() }}
                </span>
            </div>
        </div>
    </div>
    <br><br>
@endsection
