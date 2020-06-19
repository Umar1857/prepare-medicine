@extends('frontend.master-frontend')
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
<div class="container-fluid">
    <div class='page_banner_img_common'>
        <img src='/frontend/images/pages-banner.png' class='img-fluid'>
        <div class='overlay__'>
            <p>Add Questions</p>
        </div>
    </div>
    
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
            <form action="{{ url('user/question/add/multi') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Category</label>
                    <select class="select-2 form-control" name="category">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Enter Question</label>
                    <textarea class="form-control my-editor" name="question"></textarea>
                </div>

                <div class="form-group">
                    <input type="checkbox" name="answer[0]" value="0">
                    <label>OPtion A</label>
                    <input type="text" class="form-control" name="ans[]">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="answer[1]" value="1">
                    <label>OPtion B</label>
                    <input type="text" class="form-control" name="ans[]">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="answer[2]" value="2">
                    <label>OPtion C</label>
                    <input type="text" class="form-control" name="ans[]">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="answer[3]" value="3">
                    <label>OPtion D</label>
                    <input type="text" class="form-control" name="ans[]">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="answer[4]" value="4">
                    <label>OPtion E</label>
                    <input type="text" class="form-control" name="ans[]">
                </div>

                <div class="form-group">
                    <label>Explanation (Optional)</label>
                    <textarea class="form-control my-editor" name="explanation"></textarea>
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
<br>
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
