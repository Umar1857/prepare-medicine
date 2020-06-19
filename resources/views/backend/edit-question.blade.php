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

    <div class="panel panel-white">
        @if (session("success"))
            <div class="alert alert-success">
                {{ session("success") }}
            </div>
        @endif
        <div class="panel-heading clearfix">
            <form class="custom_form" action="{{ url('admin/question/edit/single') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category">
                        @foreach ($category as $value)
                            @if ($item->cat_id == $value->id)
                                <option selected value="{{ $value->id }}" >{{ $value->name }}</option>
                            @else
                                <option value="{{ $value->id }}" >{{ $value->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group {{ $errors->has('search_id') ? ' has-error' : '' }}">
                    <label>Question Id</label>
                    <input class="form-control{{ $errors->has('search_id') ? ' has-error' : '' }}" name="search_id" value="{!! $item->search_id !!}">

                    @if ($errors->has('search_id'))
                        <span class="error-block">
                             <strong>{{ $errors->first('search_id') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                    <label>Enter Question</label>
                    <textarea class="form-control my-editor" name="question">{!! $item->question !!}</textarea>

                    @if ($errors->has('question'))
                        <span class="error-block">
                             <strong>{{ $errors->first('question') }}</strong>
                        </span>
                    @endif
                </div>

                @foreach($item->question_ans as $keys=>$value)
                    @if($keys == '0')
                        <div class="form-group">
                            <input type="radio" name="answer" id="answer0" value="0" {{ $item->ans == '0' ? 'checked' : '' }}>
                            <label>Option A</label>
                            <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                        </div>
                    @elseif($keys == '1')
                        <div class="form-group">
                            <input type="radio" name="answer" id="answer1" value="1"  {{ $item->ans == '1' ? 'checked' : '' }}>
                            <label>Option B</label>
                            <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                        </div>
                    @elseif($keys == '2')
                        <div class="form-group">
                            <input type="radio" name="answer" id="answer2" value="2"  {{ $item->ans == '2' ? 'checked' : ''}}>
                            <label>Option C</label>
                            <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                        </div>
                    @elseif($keys == '3')
                        <div class="form-group">
                            <input type="radio" name="answer" id="answer3" value="3"  {{ $item->ans == '3' ? 'checked' : '' }}>
                                <label>Option D</label>
                            <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                        </div>
                    @elseif($keys == '4')
                        <div class="form-group">
                            <input type="radio" name="answer" id="answer4" value="4"  {{ $item->ans == '4' ? 'checked' : '' }}>
                            <label>Option E</label>
                            <input type="text" class="form-control" name="ans[]" value="{{ $value->ans ?? ''}}">
                        </div>
                    @endif
                @endforeach

                @if ($errors->has('answer'))
                    <span class="error-block">
                         <strong>{{ $errors->first('answer') }}</strong>
                    </span>
                @endif

                <div class="form-group">
                    <label>Explanation (optional)</label>
                    <textarea class="form-control my-editor" name="explanation">{!! $item->explanation !!}</textarea>

                    @if ($errors->has('explanation'))
                        <span class="error-block">
                             <strong>{{ $errors->first('explanation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Hint (optional)</label>
                    <textarea class="form-control my-editor" name="hint">{!! $item->hint !!}</textarea>

                    @if ($errors->has('hint'))
                        <span class="error-block">
                             <strong>{{ $errors->first('hint') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Select Asset Files</label>
                    <input type="file" class="form-control" name="asset_files[]" multiple>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
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
