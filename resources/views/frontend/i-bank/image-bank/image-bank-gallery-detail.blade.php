@extends('frontend.master-frontend')

@section('content')
    <br>
    <!--Gallery Area Start-->
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Image Bank</p>
            </div>
        </div>
        <!--Blog Area Start-->
        <div class="blog-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 blog-post-item ml-auto mr-auto">
                        <div class="blog-wrapper blog-details">
                            <div class="blog-img img-full">
                                <img src="{{url('storage/image-bank/'.$image->image)}}" alt="">
                            </div>
                            <div class="blog-content">
                                <div class="single-item-comment-view">
                                    <span><i class="zmdi zmdi-calendar-check"></i>Created At: {{date('d M Y', strtotime($image->created_at))}}</span>
                                </div>
                                <h3>{{$image->title}}</h3>
                                <p>@php echo $image->description @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Blog Area End-->
@endsection
