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



        .action_bar .btn{
            margin-bottom: 5px;
            background: #ddd;
            border-radius: 5px;
            color: #000
        }
        .btn_r{
            float: right;
            margin-right: 3px
        }
        .fa-remove{
            color: #fff
        }
        @media only screen and (max-width: 767px) {
          .btn_r{
            float: none !important;
          }
          .action_bar .btn{
            display: block !important;
          }
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
        <h4 class="panel-title">Plab Community Questions</h4>
    </div>
    <br>
    <div style="clear:both">
        <div class="col-12">

        </div>
    </div>

    <br><br>
    <div class="panel-body">
        <div class="table-responsive">

            <form class="custom_form"action="{{ url('admin/question/select') }}" method="post">
                <table class="table table-bordered data_table">
                    <thead>
                        <tr>
                            {{-- <th>Select</th> --}}
                            <th>#</th>
                            <th>User Name</th>
                            <th>Plan</th>
                        {{-- <th>Question Id</th> --}}
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$item)
                            <tr>
                                {{-- <th><input type="checkbox" name="select[]" value="{{ $item->id }}"></th> --}}
                                <th>{{ $data->firstItem()+$key }}</th>
                                <td>{{ $item->get_user_info->f_name }} {{ $item->get_user_info->s_name }}</td>
                                <td>
                                    @if($item->get_user_info->role == 2)
                                     {{ 'Trial' }}
                                    @elseif($item->get_user_info->role == 3)
                                     {{ 'Refugees' }}
                                     @elseif($item->get_user_info->role == 5)
                                     {{ 'Basic' }}
                                     @elseif($item->get_user_info->role == 6)
                                     {{ 'Standard' }}
                                     @elseif($item->get_user_info->role == 7)
                                     {{ 'Advanced' }}
                                     @elseif($item->get_user_info->role == 8)
                                     {{ 'Professional' }}
                                    @endif
                                </td>
                            {{-- <td>{{ $item->search_id }}</td> --}}
                                <td>{!! $item->question !!}</td>
                                <td>
                                    @foreach($item->question_ans as $value)
                                        @if($item->ans == $value->answer)
                                            {{ $value->ans }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if(auth()->user()->can('View Community Question'))
                                        <a style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm" data-toggle="modal" data-target="#viewDetails{{ $item->id }}"><i class="fa fa-eye"></i></a>
                                    @endif

                                    @if(auth()->user()->can('Delete Community Question'))
                                        <a style="background-color: red; border: none;" class="btn btn-sm delete-btn" href="{{ route('admin.getCommunityQuestionsList.reject', $item->id) }}"><i class="fa fa-remove delete"></i></a>
                                    @endif
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
                @csrf
                {{-- <input type="submit" value="Delete" class="btn btn-danger"> --}}
            </form>
            <span style="float:right"> {{ $data->links() }}</span>
        </div>
    </div>
</div>
@foreach ($data as $key=>$item)
    <!-- Modal -->
    <div class="modal fade" id="viewDetails{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">


                    <form class="custom_form"action="{{ url('admin/question/edit/single') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select-2 form-control" name="category" readonly='1'>
                                @foreach ($category as $value)
                                    @if ($item->cat_id == $value->id)
                                        <option selected value="{{ $value->id }}" >{{ $value->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        {{--
                        <div class="form-group">
                            <label>Question Id</label>
                            <input class="form-control" name="search_id" value="{!! $item->search_id !!}" readonly='1'>
                        </div>
                        --}}

                        <div class="form-group">
                            <label>Question</label>
                            <textarea class="form-control my-editor" name="question" readonly='1'>{!! $item->question !!}</textarea>
                        </div>
                            @foreach($item->question_ans as $keys=>$value)
                                @if($keys == '0')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer0{{ $key }}" value="0">
                                        <label>OPtion A</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}" readonly='1'>
                                    </div>
                                @elseif($keys == '1')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer1{{ $key }}" value="1">
                                        <label>OPtion B</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}" readonly='1'>
                                    </div>
                                @elseif($keys == '2')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer2{{ $key }}" value="2">
                                        <label>OPtion C</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}" readonly='1'>
                                    </div>
                                @elseif($keys == '3')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer3{{ $key }}" value="3">
                                        <label>OPtion D</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}" readonly='1'>
                                    </div>
                                @elseif($keys == '4')
                                    <div class="form-group">
                                        <input type="radio" name="answer" id="answer4{{ $key }}" value="4">
                                        <label>OPtion E</label>
                                        <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}" readonly='1'>
                                    </div>
                                @endif
                            @endforeach
                        <div class="form-group">
                            <label>Explanation (Optional)</label>
                            <textarea class="form-control my-editor" name="explanation" readonly='1'>{!! $item->explanation !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Hint (Optional)</label>
                            <textarea class="form-control my-editor" name="hint" readonly='1'>{!! $item->hint !!}</textarea>
                        </div>

                        <!--<button type="submit" class="btn btn-primary">Submit</button>-->
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
            toolbar: "insertfile undo redo | styleselect | bold italic | fontsizeselect | forecolor backcolor | | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
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

