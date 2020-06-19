@extends('frontend.master-frontend')
@section('content')
<br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Our Team</p>
            </div>
        </div>
        <div class="container">
        {{--  data fetch from Database !!  --}}
        <div class="row">
            {!! $data !!}
        </div>

        <div class="row">
            @if(!$team_members->isEmpty())
                @foreach($team_members as $key=>$member)
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- single-courses -->
                        <div class="single-popular-courses mt--30">
                            <div class="popular-courses-image">
                                <a href="{{route('team-details',$member->id)}}"><img src="{{ asset('storage/team/'.$member->profile)}}" alt=""></a>
                            </div>
                            <div class="popular-courses-contnet">
                                <h5>{{ $member->name }}</h5>
                                <p class='text-justify'><?php echo str_limit($member->description, 80); ?></p>
                                <div class="button-block">
                                    <a href="{{route('team-details',$member->id)}}" class="botton-border">READ MORE</a>
                                </div>
                            </div>
                        </div><!--// single-courses -->
                    </div>
                @endforeach
            @endif
        </div>
        </div>
    </div>
    <br>
@endsection
