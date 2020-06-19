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
                <a class="btn btn-info" href="{{ url('admin/recall/question/single/'.$id) }}">show singlechoice Question</a>
                <a class="btn btn-info" href="{{ url('admin/recall/question/multi/'.$id) }}">Show multichoice question</a>
            </div>
        @endif

        @if(auth()->user()->can('Create Question'))
            <div class="panel-heading clearfix btn-right">
                <a class="btn btn-info" href="{{ url('admin/recall/question/add/single/'.$id) }}">Add Question(Single Answer )</a>
                <a class="btn btn-info" href="{{ url('admin/recall/question/add/multi/'.$id) }}">Add Question(Multi Answer )</a>
            </div>
        @endif

    <br><br><br>
        @if(auth()->user()->can('Create Question'))
            <div style="clear:both">
                <div class="col-12">
                    <p>Mock Upload Single type Question</p>
                    <form class="form-inline" method="post" action="{{ url('admin/recall/question/import') }}" enctype="multipart/form-data">
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
            <form action="{{ url('admin/question/select') }}" method="post">
                <table class="table table-bordered" id="table_id">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>#</th>
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
                                <td>{!! $item->question !!}</td>
                                <td>
                                    @foreach($item->question_ans as $value)
                                        @if($item->ans == $value->answer)
                                            {{ $value->ans }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if(auth()->user()->can('Edit Question'))
                                        <a data-toggle="modal" data-target="#EditCat{{ $item->id }}"><i class="fa fa-edit edit"></i></a>
                                    @endif

                                    @if(auth()->user()->can('Delete Question'))
                                        <a href="{{ url('admin/question/drop/'.$item->id) }}"><i class="fa fa-remove delete"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @csrf

                @if(auth()->user()->can('Delete Question'))
                    <input type="submit" value="Delete" class="btn btn-danger">
                @endif
            </form>
            <span style="float:right"> {{ $data->links() }}</span>
        </div>
    </div>
</div>
@foreach ($data as $key=>$item)
    <!-- Modal -->
    <div class="modal fade" id="EditCat{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">


                    <form action="{{ url('admin/recall/question/edit/single') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="status" value="{{ $id }}">

                        <div class="form-group">
                            <label>Enter Question</label>
                            <textarea class="form-control my-editor" name="question">{!! $item->question !!}</textarea>
                        </div>
                            @foreach($item->question_ans as $keys=>$value)
                                @if($keys == '0')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer0{{ $key }}" value="0">
                                        <label>OPtion A</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                                    </div>
                                @elseif($keys == '1')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer1{{ $key }}" value="1">
                                        <label>OPtion B</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                                    </div>
                                @elseif($keys == '2')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer2{{ $key }}" value="2">
                                        <label>OPtion C</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                                    </div>
                                @elseif($keys == '3')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer3{{ $key }}" value="3">
                                        <label>OPtion D</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                                    </div>
                                @elseif($keys == '4')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer4{{ $key }}" value="4">
                                        <label>OPtion E</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                                    </div>
                                @endif
                            @endforeach
                        <div class="form-group">
                            <label>Explanation (Optional)</label>
                            <textarea class="form-control my-editor" name="explanation">{!! $item->explanation !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hint (Optional)</label>
                            <textarea class="form-control my-editor" name="hint">{!! $item->hint !!}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endforeach

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
            toolbar: "insertfile undo redo | styleselect | bold italic | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
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
