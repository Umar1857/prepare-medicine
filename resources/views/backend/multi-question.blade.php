@extends('backend.master-backend')
@section('js-css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <style>
        .panel-white{
            background: white;
            padding: 10px;
        }
        .btn-left{
            float: left;
        }
        .btn-right{
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

    </style>
@endsection
@section('content')
<br>

<div class="panel panel-white">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session("success"))
        <div class="alert alert-success">
            {{ session("success") }}
        </div>
    @endif
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Question</h4>
    </div>

        @if(auth()->user()->can('View Question'))
            <div class="panel-heading clearfix btn-left">
                <a class="btn btn-info" href="{{ url('admin/question/single') }}">show singlechoice Question</a>
                <a class="btn btn-info" href="{{ url('admin/question/multi') }}">Show multichoice question</a>
            </div>
        @endif


        @if(auth()->user()->can('Create Question'))
            <div class="panel-heading clearfix btn-right">
                <a class="btn btn-info" href="{{ url('admin/question/add/single') }}">Add Question(Single Answer )</a>
                <a class="btn btn-info" href="{{ url('admin/question/add/multi') }}">Add Question(Multi Answer )</a>
            </div>
        @endif

        <br><br><br>

        @if(auth()->user()->can('Create Question'))
            <div style="clear:both">
                <div class="col-12">
                    <p>Mock Upload Multi type Question</p>
                    <form class="form-inline" method="post" action="{{ url('admin/question/import') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="pwd">Excel File</label>
                            <input type="file" class="form-control" id="pwd" name="excel">
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
        @endif
    <br><br>
    <div class="panel-body">
        <div class="table-responsive">

            <form class="form-inline" action="{{ url('admin/question/filter/multi') }}" method="GET" style="float:right">
                <div class="form-group mb-2">
                    <select class="form-control" name="sear_id">
                        <option value="cat">Category</option>
                        <option value="sear">Search Id</option>
                        <option value="key">Keyword(from question)</option>
                    </select>
                </div>

                <div class="form-group mx-sm-2 mb-2">
                    <select class="form-control" name="category">
                        <option value="">Select A Category</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputPassword2" class="sr-only">Search</label>
                    <input type="text" class="form-control" id="inputPassword2" name="sear_key" placeholder="category/search id/question">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Search</button>
            </form>

            <form action="{{ url('admin/question/select') }}" method="post">

                @if(auth()->user()->can('Delete Question'))
                    <div>
                        <input type="checkbox" class="select-all"> Select All
                        <input type="submit" value="Delete" class="btn btn-danger select-all-delete ml-2">
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>#</th>
                            <th>Question Id</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$item)
                            <tr>
                                <th><input type="checkbox" name="select[]" value="{{ $item->id }}"></th>
                                <th>{{ $data->firstItem()+$key }}</th>
                                <td>{{ $item->search_id }}</td>
                                <td>{!! $item->question !!}</td>
                                <td>
                                    @php
                                        $answers = explode('-',$item->ans);
                                    @endphp
                                    @foreach($item->question_ans as $value)
                                        @foreach ($answers as $key=>$answer)
                                            @if($answer == $value->answer)
                                                @if ($answer == null)
                                                    @continue
                                                @endif
                                                <li>{{ $value->ans }}</li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </td>
                                <td>
                                    @if(auth()->user()->can('Edit Question'))
                                        <a href="{{route('edit_multi_question', $item->id)}}"><i class="fa fa-edit edit"></i></a>
                                    @endif

                                    @if(auth()->user()->can('Delete Question'))
                                        <a href="{{ url('admin/question/drop/'.$item->id) }}"><i class="fa fa-remove delete delete-btn"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @csrf
            </form>
            <span style="float:right"> {{ $data->links() }}</span>
        </div>
    </div>
</div>

@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $('.select-2').select2();
        });
    </script>

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

