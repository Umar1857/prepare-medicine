@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


@endsection

@section('content')

    <div class="alert alert-info" role="alert">Edit Image</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('image-bank.update',$image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label><b>Title</b></label>
            <input id="title" type="text" name="title" placeholder="Enter Title..." class="form-control" value="{{$image->title}}">
        </div>

        <div class="form-group">
            <label><b>Category</b></label>
            <select id="category" class="form-control select2-dropdown" name="category" required autocomplete="category">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{$item->id === $image->category_id ? 'selected': ''}}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><b>Description</b></label>
            <textarea name="description" class="form-control my-editor">{{$image->description}}</textarea>
        </div>

        <div class="form-group">
            <label><b>Image</b></label>
            <input id="title" type="file" name="image" class="form-control">
        </div>

        <label><b>Uploaded Image</b></label>
        <div class="form-group">
            <img src="{{url('storage/image-bank/'.$image->image)}}" width="200px" height="150px">
        </div>

        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="CREATE NEW IMAGE" style="float:right">
    </form>

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

