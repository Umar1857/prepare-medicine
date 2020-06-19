@extends('frontend.master-frontend')
@section('content')
<br>

<div class='container-fluid'>
    
    <div class='page_banner_img_common'>
        <img src='/frontend/images/pages-banner.png' class='img-fluid'>
        <div class='overlay__'>
            <p>All News & Updates</p>
        </div>
    </div>
    
    <div class="container">
        <div class="row align-items-stretch">

        @if(!$blogs->isEmpty())
        @foreach($blogs as $key=>$blog)
            <div class="align-self-stretch col-lg-4 col-md-6 col-12">
                <!-- single-courses -->
                <div class=" single-our-blog mt--30">
                    <div class="our-blog-image">
                        <a href="#"><img src="{{ url('storage/blog/'.$blog->featured_img) }}" alt=""></a>
                        <span class="in-our-blog-icon">
                            <img src="{{ url('frontend/images/icon/our-blog-01.png') }}" alt="">
                        </span>
                    </div>
                    <div class="our-blog-contnet">
                        <h5><a href="">{{ $blog->title }}</a></h5>
                        <div class="post_meta">
                            <!-- <ul>
                                <li><p>By: <a href="#">Sekh Rana</a></p></li>
                                <li><p>15 Fab 2018</p></li>
                            </ul> -->
                        </div>
                        <div class="text-justify">
                            <?php echo str_limit($blog->description, 110); ?>
                        </div>
                        
                        
                        <div class="button-block">
                            <a href="{{ route('newsDetails', $blog->id) }}" class="botton-border">Read more</a>
                        </div>
                    </div>
                </div><!--// single-courses -->
            </div>
        @endforeach
    @endif
    </div>

    </div>
    
    <div class='col-12'>
        {!! $blogs->render() !!}
    </div>
    <br/>
</div>
            
@endsection