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

    <div class="alert alert-info" role="alert">Edit Webinar</div>
    @include('msg.msg')

    <form class="custom_form" action="{{ route('webinars.update', $webinar->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label><b>Title</b></label>
            <input id="title" type="text" name="title" value="{{ $webinar->title }}" class="form-control">
            <br>
        </div>
        <div class="form-group">
            <label><b>Description</b></label>
            <textarea id="description" name="description" class="form-control my-editor">{!! $webinar->description !!}</textarea>
            <br>
        </div>

        <div class="form-group">
            <label><b>Content</b></label>
            <textarea id="description" name="content" class="form-control my-editor">{!! $webinar->content !!}</textarea>
        </div>

        <div class="form-group">
            <label><b>Category</b></label>
            <select id="category" class="form-control select2-dropdown" name="category" required autocomplete="category">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{$item->id === $webinar->category_id ? 'selected' : ''}}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><b>Presenter</b></label>
            <select id="presenter" class="form-control select2-dropdown" name="presenter" required autocomplete="presenter">
                @foreach ($users as $item)
                    <option value="{{ $item->id }}" {{$item->id === $webinar->user_id ? 'selected' : ''}}>{{ $item->f_name.' '.$item->s_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><b>Start On</b></label>
            <input id="title" type="text" name="start" class="form-control datetime-picker" value="{{date('m/d/Y h:i:s', strtotime($webinar->start))}}">
        </div>

        <div class="form-group">
            <label><b>Ends On</b></label>
            <input id="title" type="text" name="end" class="form-control datetime-picker" value="{{date('m/d/Y h:i:s', strtotime($webinar->end))}}">
        </div>

        <div class="form-group">
            <label><b>Video Link</b></label>
            <input id="title" type="text" name="video_link" class="form-control" placeholder="Add the Video link" value="{{$webinar->video_link}}">
        </div>

        <label><b>Video</b></label>
        <input id="video" type="file" name="video">
        <br>

        <label><b>Featured Image</b></label>
        <input id="featured_img" type="file" name="featured_img" accept="image/*">
        <br>
        <input type="submit" class="btn btn_custom_style btn-primary" value="UPDATE WEBINAR" style="float:right">
    </form>

    <div class="row">
        <div class="col-md-12 current">
            <label><b>Current Featured Image</b></label>
            <div>
                <img src="{{ url('storage/webinar/'.$webinar->image) }}" width="200px">
            </div><br>
        </div>

        @if(!empty($webinar->video))
            <div class="col-md-12 current">
                <label><b>Webinar Video</b></label>
                <div>
                    <video width="200" height="150" controls>
                        <source src="{{url('storage/webinar/'.$webinar->video)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div><br>
            </div>
        @endif

        @if(!empty($webinar->video_link))
            <div class="col-md-12 current">
                <label><b>Embeded Webinar Video</b></label>
                <div>
                    <iframe width="350" height="200" src="{{$webinar->video_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        @endif
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
