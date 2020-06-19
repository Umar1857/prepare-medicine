@extends('backend.master-backend')

@section('js-css')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>


@endsection

@section('content')
    <br>

    <div class="alert alert-info" role="alert">Plab Course Detail</div>
    @include('msg.msg')

    <form>
        @csrf
        <div class="form-group">
            <label><b>Title</b></label>
            <input id="title" type="text" name="title" placeholder="Enter title..." class="form-control" value="{{$course->title}}">
        </div>

        <div class="form-group">
            <label><b>Course Description</b></label>
            <textarea id="description" name="description" class="form-control my-editor">{{$course->description}}</textarea>
        </div>

        <div class="form-group">
            <label><b>Course Content</b></label>
            <textarea id="description" name="content" class="form-control my-editor">{{$course->content}}</textarea>
        </div>

        <div class="form-group">
            <label><b>Category</b></label>
            <select id="category" class="form-control select2-dropdown" name="category" required autocomplete="category">
                @foreach ($categories as $item)
                    <option value="{{ $item->id }}" {{$item->id === $course->category_id ? 'selected' : ''}}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><b>Presenter</b></label>
            <select id="presenter" class="form-control select2-dropdown" name="presenter" required autocomplete="presenter">
                @foreach ($users as $item)
                    <option value="{{ $item->id }}" {{$item->id === $course->user_id ? 'selected' : ''}}>{{ $item->f_name.' '.$item->s_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label><b>Start On</b></label>
            <input id="title" type="text" name="start" class="form-control datetime-picker" value="{{date('m/d/Y h:i:s', strtotime($course->start))}}">
        </div>

        <div class="form-group">
            <label><b>Ends On</b></label>
            <input id="title" type="text" name="end" class="form-control datetime-picker" value="{{date('m/d/Y h:i:s', strtotime($course->end))}}">
        </div>

        <div class="form-group">
            <label><b>Time Duration</b></label>
            <input id="title" type="text" name="time" class="form-control datetime-picker" value="{{date('m/d/Y h:i:s', strtotime($course->time))}}">

        </div>

        <div class="form-group">
            <label><b>Duration</b></label>
            <input id="title" type="text" name="duration" placeholder="Enter duration..." class="form-control" value="{{$course->duration}}">

        </div>

        <div class="form-group">
            <label><b>No. of Lectures</b></label>
            <input id="title" type="number" name="lectures" placeholder="Enter no of lectures..." class="form-control" value="{{$course->lectures}}">

        </div>

        <div class="form-group">
            <label><b>Course Type</b></label>
            <select id="course_type" class="form-control" name="course_type" required autocomplete="course_type">
                <option value="">Select Course Type</option>
                <option value="1" {{$course->is_online ? 'selected' : ''}}>Online</option>
                <option value="0" {{!$course->is_online ? 'selected' : ''}}>Face to Face</option>
            </select>
        </div>

        <div class="form-group">
            <label><b>Payment Option</b></label>
            <select id="payment_option" class="form-control" name="payment_option" required autocomplete="payment_option">
                <option value="">Select Payment Option</option>
                <option value="1" {{$course->is_paid ? 'selected' : ''}}>Paid</option>
                <option value="0" {{!$course->is_paid ? 'selected' : ''}}>Free</option>
            </select>
        </div>


        <div class="form-group" id="price_field">
            <label><b>Price</b></label>
            <input id="title" type="text" name="price" placeholder="Enter price..." class="form-control" value="{{$course->price}}">

        </div>

        <div class="form-group">
            <label><b>Address</b></label>
            <input id="title" type="text" name="address" placeholder="Enter title..." class="form-control" value="{{$course->address}}">

        </div>

        <div class="form-group">
            <label><b>City</b></label>
            <input id="title" type="text" name="city" placeholder="Enter title..." class="form-control" value="{{$course->city}}">

        </div>

        <div class="form-group">
            <label><b>State</b></label>
            <input id="title" type="text" name="state" placeholder="Enter title..." class="form-control" value="{{$course->state}}">

        </div>

        <div class="form-group">
            <label><b>Country</b></label>
            <select id="country" class="form-control select2-dropdown" name="country" required autocomplete="country">
                @foreach ($countries as $item)
                    <option value="{{ $item->country_name }}" {{$item->country_name === $course->country ? 'selected' : ''}}>{{ $item->country_name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="row">
        <div class="col-md-12 current">
            <label><b>Current Featured Image</b></label>
            <div>
                <img src="{{ url('storage/plab-courses/'.$course->image) }}">
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
