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
            <h4 class="panel-title">Video Bank</h4>
        </div>

        @if(auth()->user()->can('Create Video Bank'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('video-bank.create') }}" class="btn btn-sencodary">Add Video</a>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Speciality</th>
                        <th>Video</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td>{{$video->title}}</td>
                            <td>@php echo str_limit($video->description,30)@endphp</td>
                            <td>{{ $video->category->name}}</td>
                            <td>
                                <video width="100" height="100" controls>
                                    <source src="{{url('storage/video-bank/'.$video->image)}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </td>

                            <td>
                                @if(auth()->user()->can('Edit Video Bank'))
                                    <a href="{{ route('video-bank.edit', $video->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Video Bank'))
                                    <form method="post" class="delete-form" action="{{ route('video-bank.destroy', $video->id) }}">
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

                <span style="float:right"> {{ $videos->links() }}</span>
            </div>
        </div>
    </div>


@endsection
