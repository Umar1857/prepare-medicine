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
            color: #fff
        }

    </style>
    {{-- Month Picker --}}
    <script src="//code.jquery.com/jquery-1.12.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('backend/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('backend/js/MonthPicker.min.js') }}"></script>
    <script src="{{ url('backend/js/examples.js') }}"></script>
@endsection
@section('content')
<br>

<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Categories</h4>
    </div>

    @if(auth()->user()->can('Create Recall Exam'))
        <div class="panel-heading clearfix btn-left">
            <button class="btn btn_custom_style btn-primary" data-toggle="modal" data-target="#AddExam">Add Category</button>
        </div>
    @endif

    <br><br>
    <div class="panel-body">
        @include('msg.msg')
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bulk Id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Color</th>
                        <th>Status</th>
                        <th>Preview</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <th scope="row">{{ 1+$key }}</th>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td><img src="{{ '/storage/photos/'.$item->cat_img }}" width="50px" height="40px"></td>
                            <td><div style="width: 50px; height: 40px; background-color: {{ $item->cat_color }}"></div></td>
                            <td>
                                @if(auth()->user()->can('Edit Recall Exam'))
                                    @if ($item->status == "0")
                                        <a href="{{ url('admin/recall/status/'.$item->id.'/'.'on') }}"><i class="fa fa-power-off text-danger" aria-hidden="true"></i></a>
                                    @elseif($item->status == "1")
                                        <a href="{{ url('admin/recall/status/'.$item->id.'/'.'off') }}"><i class="fa fa-power-off text-success" aria-hidden="true"></i></a>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->can('View Question'))
                                    <a href="{{ url('admin/recall/question/single/'.$item->id) }}"><i class="fa fa-eye"></i></a>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->can('Edit Recall Exam'))
                                    <a style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm" data-toggle="modal" data-target="#EditRecall{{ $item->id }}"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Recall Exam'))
                                    <a style="background-color: red; border: none;" class="btn btn-sm delete-btn" href="{{ url('admin/recall-exam/drop/'.$item->id) }}"><i class="fa fa-remove delete"></i></a>
                                @endif
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="EditRecall{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Exam</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ url('admin/recall-exam/edit/'.$item->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="month" value="0">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Exam Name</label>
                                            <input type="text" class="form-control" placeholder="Ex : Biology.." name="name" value="{{ $item->name }}">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="AddExam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/recall-exam/add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="month" value="0">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Exam Name</label>
                        <input type="text" class="form-control" placeholder="Ex : Biology.." name="name">
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
