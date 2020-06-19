@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

    <style type="text/css">
        .btn_custom_style{
            background-color: #ddd;
            color: #000
        }
        .current img{
            width: 200px
        }
    </style>
@endsection

@section('content')
<br>

    <div class="alert alert-info" role="alert">Edit News Post</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('news.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label><b>News Title</b></label>
        <input id="title" type="text" name="title" value="{{ $data->title }}" class="form-control">
        <br>
        <label><b>News Body</b></label>
        <textarea id="description" name="description" class="form-control my-editor">{!! $data->description !!}</textarea>
        <br>
        <label><b>Featured Image</b></label>
        <input id="featured_img" type="file" name="featured_img" accept="image/*">
        <br>

        <div class="form-group">
            <label><b>Add Files</b></label>
            <input type="file" name="reference_files[]" multiple>
        </div>
        <input type="submit" class="btn btn_custom_style btn-primary" value="UPDATE NEWS POST" style="float:right">
    </form>

    <div class="row">
        <div class="col-md-12 current">
        <label><b>Current Featured Image</b></label>
            <div>
                <img src="{{ url('storage/news/'.$data->featured_img) }}">
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
    <script>
        var editor_config = {
            path_absolute : "/",
            theme: "modern",
            selector: "textarea.my-editor",
            images_upload_url: 'http://preparemedicine.test/admin/ui/news-images-upload',
            images_upload_base_path: '/',
            plugins: [
            "advlist autolink lists link image imagetools charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern code"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code",
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
