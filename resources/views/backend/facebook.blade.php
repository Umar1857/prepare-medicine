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


        .btn_custom_style{
            background-color: #ddd;
            color: #000
        }
        .fa-remove{
            color: #fff;
        }

    </style>
@endsection
@section('content')
<br>

<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Facebook Group</h4>
    </div>

    @if(auth()->user()->can('Create Community Facebook'))
        <div class="panel-heading clearfix btn-left">
            <button class="btn btn_custom_style btn-primary" data-toggle="modal" data-target="#AddCat">Add Facebook Group</button>
        </div>
    @endif

    <br><br>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered data_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <th scope="row">{{ $data->firstItem()+$key }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->link }}</td>
                            <td><img src="{{ url('storage/community-groups/'.$item->cat_img) }}" alt="" style="width:100px"></td>
                            <td>
                                @if(auth()->user()->can('Edit Community Facebook'))
                                    <a style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm" data-toggle="modal" data-target="#EditCat{{ $item->id }}"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Community Facebook'))
                                    <a style="background-color: red; border: none;" class="btn btn-sm delete-btn" href="{{ url('admin/Community/drop/'.$item->id) }}"><i class="fa fa-remove delete"></i></a>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="EditCat{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Facebook Group</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form class="custom_form"action="{{ url('admin/Community/facebook/edit/'.$item->id) }}" method="post" enctype='multipart/form-data'>
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Group Name</label>
                                            <input type="text" class="form-control" placeholder="Ex : Global.." name="name" value="{{ $item->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Link</label>
                                            <input type="text" class="form-control" name="link" value="{{ $item->link }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Link</label>
                                            <input type="file" class="form-control" name="cat_img">
                                        </div>
                                        <input type="submit" value="Update" class="btn btn-success col-12">
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
              <h5 class="modal-title" id="exampleModalLabel">Add Facebook Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="custom_form"action="{{ url('admin/Community/facebook/add') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Group Name</label>
                        <input type="text" class="form-control" placeholder="Ex : Global.." name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link</label>
                        <input type="text" class="form-control" name="link">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" name="cat_img">
                    </div>
                    <input type="submit" value="Place It" class="btn btn-success col-12">
                </form>
            </div>
          </div>
        </div>
      </div>

@endsection
