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
        .right{
            float: right;
        }
        .border{
            border: 10px solid green;
        }
        .block{
            display: block;
        }
        li{
            list-style-type: none;
        }
    </style>

@endsection
@section('content')
<br>

    {{--  data fetch from Database !!  --}}
    <div class="panel panel-warning">
        <div class="col-12 block">
            <button class="btn btn-primary right" data-toggle="modal" data-target="#add-video">Add Video</button>
        </div>
        <div class="panel-body">
            <div class="container">
                <div class="row">
                    @foreach ($data as $item)
                        <div class="border col-4">
                                <li><iframe  class="col-12 embed-responsive-item p-0" src="{{ $item->path }}" allowfullscreen></iframe></li>
                                <li><a href="{{ url('admin/video/drop/'.$item->id) }}" class="btn btn-danger">Delete</a></li>
                        </div>
                    @endforeach
                </div>
                <br>
                <span>
                    {{ $data->links() }}
                </span>
            </div>
        </div>
    </div>
    <br><br>
    {{-- add video model --}}
    <div class="modal fade" id="add-video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('admin/video/add') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="sr-only">Video address</label>
                            <input type="text" class="form-control" name="video" placeholder="Online Video address Ex: https://www.youtube.com/embed/v64KOxKVLVg">
                        </div>
                        <div class="form-group">
                            <label class="sr-only">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Video title">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
