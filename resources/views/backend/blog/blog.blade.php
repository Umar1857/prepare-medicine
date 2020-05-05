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
        <h4 class="panel-title">Blog Posts</h4>
    </div>
    <div class="panel-heading clearfix btn-left">
        <a href="{{ route('blog.create') }}" class="btn btn-sencodary">Add Post</a>
    </div>
    <br><br>
    <div class="panel-body">
        @include('msg.msg')
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <td scope="row">{{ $key+1 }}</td>
                            <td >{{ $item->title }}</td>
                            <td ><?php echo str_limit($item->description, 50); ?></td>
                            <td><img src="{{ url('storage/blog/'.$item->featured_img) }}" alt="" style="width:100px"></td>
                            <td>
                                <a href="{{ route('blog.edit', $item->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                
                                <!-- delete code start from here -->
                                <form style="display:none;" id="delete-form-{{ $item->id }}" action="{{ route('blog.destroy', $item->id) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                </form>

                                <button type="button" style="background-color: red; color: #fff; border: none;" class="btn btn-sm"
                                  onclick="if(confirm('Are you sure to Delete?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $item->id }}').submit();
                                  }else{
                                    event.preventDefault();
                                  }"
                                >
                                    <i class="fa fa-trash"></i>
                                </button>
                                <!-- delete code end from here -->
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <span>{{ $data->render() }}</span>
    </div>
</div>


@endsection
