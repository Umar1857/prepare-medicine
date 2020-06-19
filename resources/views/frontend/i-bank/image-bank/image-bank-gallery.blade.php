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

        <div class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    @foreach($images as $image)
                    <!--Single Gallery Image Start-->
                    <div class="col-md-4 col-sm-6">
                        <div class="single-gallery-img mb-30">
                            <img src="{{url('storage/image-bank/'.$image->image)}}" alt="">
                            <div class="gallery-overlay">
                                <a class="view-only" href="{{url('storage/image-bank/'.$image->image)}}" data-fancybox="images"><i class="zmdi zmdi-eye"></i></a>
                                <a href="{{ url('i-bank/image-bank-gallery-detail/'.$image->id) }}" >View Details</a>
                            </div>
                        </div>
                    </div>
                    <!--Single Gallery Image End-->
                    @endforeach
                </div>
            </div>
        </div>
        <!--Gallery Area End-->
    </div>
@endsection
