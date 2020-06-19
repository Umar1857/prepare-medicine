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

    </style>
@endsection
@section('content')
<br>

    <div class="panel panel-white">
        @if (session("success"))
            <div class="alert alert-success">
                {{ session("success") }}
            </div>
        @endif
        <div class="panel-heading clearfix">
            <form action="{{ url('admin/question/add/single') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                    <label>Category</label>
                    <select class="select-2 form-control" name="category">
                        @foreach ($category as $item)
                            <Option value="{{ $item->id }}" {{$item->id == old('category') ? 'selected' : ''}}>{{ $item->name }}</Option>
                        @endforeach
                    </select>

                    @if ($errors->has('category'))
                        <span class="error-block">
                             <strong>{{ $errors->first('category') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('question_id') ? ' has-error' : '' }}">
                    <label>Question Id</label>
                    <input type="text" class="form-control{{ $errors->has('question_id') ? ' has-error' : '' }}" name="question_id" value="{{old('question_id') ? old('question_id') : ''}}">

                    @if ($errors->has('question_id'))
                        <span class="error-block">
                             <strong>{{ $errors->first('question_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                    <label>Enter Question</label>
                    <textarea class="form-control my-editor" name="question">{!! old('question') !!}</textarea>

                    @if ($errors->has('question'))
                        <span class="error-block">
                             <strong>{{ $errors->first('question') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <div>
                        <label>Enter Answer</label>
                    </div>

                    <input type="radio" name="answer" value="0">
                    <label>Option A</label>
                    <input type="text" class="form-control{{ $errors->has('answer') ? ' has-error' : '' }}" name="ans[]" value="{{old('ans') ? old('ans')[0] : ''}}">

                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <input type="radio" name="answer" value="1">
                    <label>Option B</label>
                    <input type="text" class="form-control{{ $errors->has('answer') ? ' has-error' : '' }}" name="ans[]" value="{{old('ans') ? old('ans')[1] : ''}}">
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <input type="radio" name="answer" value="2">
                    <label>Option C</label>
                    <input type="text" class="form-control{{ $errors->has('answer') ? ' has-error' : '' }}" name="ans[]" value="{{old('ans') ? old('ans')[2] : ''}}">
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <input type="radio" name="answer" value="3">
                    <label>Option D</label>
                    <input type="text" class="form-control{{ $errors->has('answer') ? ' has-error' : '' }}" name="ans[]" value="{{old('ans') ? old('ans')[3] : ''}}">
                </div>
                <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                    <input type="radio" name="answer" value="4">
                    <label>Option E</label>
                    <input type="text" class="form-control{{ $errors->has('answer') ? ' has-error' : '' }}" name="ans[]" value="{{old('ans') ? old('ans')[4] : ''}}">
                </div>

                @if ($errors->has('answer'))
                    <span class="error-block">
                         <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                @endif

                <div class="form-group{{ $errors->has('explanation') ? ' has-error' : '' }} ">
                    <label>Explanation (Optional)</label>
                    <textarea class="form-control my-editor" name="explanation">{!! old('explanation') !!}</textarea>

                    @if ($errors->has('explanation'))
                        <span class="error-block">
                             <strong>{{ $errors->first('explanation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('hint') ? ' has-error' : '' }}">
                    <label>Hint (Optional)</label>
                    <textarea class="form-control my-editor" name="hint">{!! old('hint') !!}</textarea>

                    @if ($errors->has('hint'))
                        <span class="error-block">
                             <strong>{{ $errors->first('hint') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('asset_files') ? ' has-error' : '' }}">
                    <label>Select Asset Files</label>
                    <input type="file" class="form-control" name="asset_files[]" multiple>

                    @if ($errors->has('asset_files'))
                        <span class="error-block">
                             <strong>{{ $errors->first('asset_files') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
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
