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
            <h4 class="panel-title">Categories</h4>
        </div>

        @if(auth()->user()->can('Create Category'))
            <div class="panel-heading clearfix btn-left">
                <button class="btn btn-sencodary" data-toggle="modal" data-target="#AddCat">Add Category</button>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Bulk Id</th>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <td scope="row">{{ $data->firstItem()+$key }}</td>
                            <td >{{ $item->id }}</td>
                            <td >{{ $item->cat_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img src="{{ url('storage/photos/'.$item->cat_img) }}" alt="" style="width:100px"></td>
                            <td><div style="background:{{ $item->cat_color }};width:100px;height:50px"></div></td>
                            <td>
                                @if(auth()->user()->can('Edit Category'))
                                    <a style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm" data-toggle="modal" data-target="#EditCat{{ $item->id }}"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Category'))
                                    <a style="background-color: red; color: #fff; border: none;" class="btn btn-sm delete-btn" href="{{ url('admin/category/drop/'.$item->id) }}"><i class="fa fa-remove delete"></i></a>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="EditCat{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="custom_form" action="{{ url('admin/category/add/update/'.$item->id) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Name</label>
                                                <input type="text" class="form-control" placeholder="Ex : Biology.." name="cat_name" value="{{ $item->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Id</label>
                                                <input type="text" class="form-control" placeholder="Ex : Biology.." name="cat_id" value="{{ $item->cat_id }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Image</label>
                                                <input type="file" class="form-control" name="cat_img" value="{{ $item->cat_img }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Category Color</label>
                                                <input type="color" class="form-control" name="cat_color" value="{{ $item->cat_color }}">
                                            </div>
                                            <input type="submit" value="Place It" class="btn btn-success col-12">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <span>{{ $data->links() }}</span>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="AddCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="custom_form" action="{{ url('admin/category/add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Name</label>
                            <input type="text" class="form-control" placeholder="Ex : Biology.." name="cat_name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Image</label>
                            <input type="file" class="form-control" name="cat_img" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Color</label>
                            <input type="color" class="form-control" name="cat_color" >
                        </div>
                        <input type="submit" value="Place It" class="btn btn-success col-12">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
