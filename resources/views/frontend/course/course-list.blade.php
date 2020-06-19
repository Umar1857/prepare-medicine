@extends('frontend.master-frontend')
@section('content')
<br>

<div class='container-fluid'>
    <div class='page_banner_img_common'>
        <img src='/frontend/images/pages-banner.png' class='img-fluid'>
        <div class='overlay__'>
            <p>All Courses</p>
        </div>
    </div>
    
    
    <div class="row">
        @if(!$course_list->isEmpty())
        @foreach($course_list as $key=>$course)
            <div class="col-lg-4 col-md-6 col-12">
            <!-- single-courses -->
            <div class="single-popular-courses mt--30">
                <div class="popular-courses-image">
                    <a href="{{ route('courseDetails.show', $course->id) }}"><img src="{{ url('storage/course/'.$course->featured_img) }}" alt=""></a>
                </div>
                <div class="popular-courses-contnet">
                    {{-- <h5>{{ $course->title }}</h5> --}}
                    <div class="post_meta">
                        <ul>
                            <li><a href="{{ route('courseDetails.show', $course->id) }}">{{ $course->title }}</a></li>
                            {{-- <li><p>Duration : {{ $course->duration }}</p></li> --}}
                        </ul>
                    </div>
                    <p class='text-justify'><?php echo str_limit($course->description, 80); ?></p>
                    <div class="button-block">
                        <a href="{{ route('subscription_plans', $course->title) }}" class="botton-border">SUBSCRIBE</a>
                    </div>
                </div>
            </div><!--// single-courses -->
        </div>
        @endforeach
    @endif
    </div>
    
    <div class='col-12'>
        {!! $course_list->render() !!}
    </div>
    <br/>
</div>
            
@endsection