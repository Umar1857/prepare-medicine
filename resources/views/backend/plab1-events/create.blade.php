@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


@endsection

@section('content')
<br>

    <div class="alert alert-info" role="alert">Create Event</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label><b>Title</b></label>
        <input id="title" type="text" name="title" placeholder="Enter title..." class="form-control">
        <br>

        <label><b>Description</b></label>
        <textarea id="description" name="description" class="form-control my-editor"></textarea>
        <br>

        <label><b>Event Content</b></label>
        <textarea id="description" name="content" class="form-control my-editor"></textarea>
        <br>

        <div class="form-group">
            <label><b>Category</b></label>
            <select id="category" class="form-control select2-dropdown" name="category" required autocomplete="category">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            <br>
        </div>

        <label><b>Start Date and Time</b></label>
        <input id="title" type="text" name="start" class="form-control datetime-picker">
        <br>

        <label><b>End Date and Time</b></label>
        <input id="title" type="text" name="end" class="form-control datetime-picker">
        <br>

        <label><b>Address</b></label>
        <input id="title" type="text" name="address" placeholder="Enter title..." class="form-control">
        <br>

        <label><b>City</b></label>
        <input id="title" type="text" name="city" placeholder="Enter title..." class="form-control">
        <br>

        <label><b>State</b></label>
        <input id="title" type="text" name="state" placeholder="Enter title..." class="form-control">
        <br>

        <div class="form-group">
            <label><b>Country</b></label>
            <select id="country" class="form-control select2-dropdown" name="country" required autocomplete="country">
                @foreach ($countries as $item)
                    <option value="{{ $item->country_name }}">{{ $item->country_name }}</option>
                @endforeach
            </select>
            <br>
        </div>

        <label><b>Featured Image</b></label>
        <input id="featured_img" type="file" name="featured_img" accept="image/*">
        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="SAVE PLAB EVENT" style="float:right">
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
