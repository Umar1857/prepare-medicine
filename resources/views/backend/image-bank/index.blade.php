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
            <h4 class="panel-title">Image Bank</h4>
        </div>

        @if(auth()->user()->can('Create Image Bank'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('image-bank.create') }}" class="btn btn-sencodary">Add Image</a>
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
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{$image->title}}</td>
                            <td>@php echo str_limit($image->description,30)@endphp</td>
                            <td>{{$image->category->name}}</td>
                            <td><img src="{{url('storage/image-bank/'.$image->image)}}" width="100px" height="100px"></td>
                            <td>
                                @if(auth()->user()->can('Edit Image Bank'))
                                    <a href="{{ route('image-bank.edit', $image->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Image Bank'))
                                    <form method="post" class="delete-form" action="{{ route('image-bank.destroy', $image->id) }}">
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

                <span style="float:right"> {{ $images->links() }}</span>
            </div>
        </div>
    </div>


@endsection
