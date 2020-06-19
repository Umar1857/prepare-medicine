@extends('backend.master-backend')
@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
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

    </style>
@endsection
@section('content')
<br>

<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Notification</h4>
    </div>
    <div class="panel-heading clearfix btn-left">
        <button class="btn btn_custom_style btn-primary" data-toggle="modal" data-target="#AddCat">Send Notification</button>
    </div>
    <br><br>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered data_table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Expired</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <th scope="row">{{ $data->firstItem()+$key }}</th>
                            <td>{{ $item->title }}</td>
                            <td>{!! $item->description !!}</td>
                            <td>{{ $item->expired }}</td>
                            <td>
                                @if(auth()->user()->can('Edit Notification'))
                                    <a data-toggle="modal" data-target="#EditCat{{ $item->id }}"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Notification'))
                                    <a href="{{ url('admin/notification/drop/'.$item->id) }}" class="delete-btn"><i class="fa fa-remove delete"></i></a>
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
                                    <form action="{{ url('admin/notification/edit') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Notification Title</label>
                                            <input type="text" class="form-control" placeholder="Ex : Biology.." name="title" value="{{ $item->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Notification Description</label>
                                            <textarea class="form-control my-editor" placeholder="Ex : Biology.." name="description">{!! $item->description !!}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Notification Expired</label>
                                            <input type="date" class="form-control" name="expired" value="{{ $item->expired }}">
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
                <form action="{{ url('admin/notification/add') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Notification Title</label>
                        <input type="text" class="form-control" placeholder="Ex : Biology.." name="title" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Notification Description</label>
                        <textarea class="form-control my-editor" placeholder="Ex : Biology.." name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Notification Expired</label>
                        <input type="date" class="form-control" name="expired">
                    </div>
                    <input type="submit" value="Place It" class="btn btn-success col-12">
                </form>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('js')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- editor --}}
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };

        tinymce.init(editor_config);
    </script>

@endsection
