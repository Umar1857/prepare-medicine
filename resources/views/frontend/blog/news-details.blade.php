@extends('frontend.master-frontend')
@section('js-css')
    <style type="text/css">
        p{
        	text-align: justify;
        }
        h4{
        	margin-top: 30px;
        	border-bottom: 1px solid #ddd
        }

        ul{
        	display: block;
        	list-style-type: square;
        	margin-left: 25px;
        }

        .heading_{border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 30px;
            text-align: center;
        }

    </style>
@endsection

@section('content')
<br>
    <br>
        <div class="container">
            <h3 class="heading_">{{ $data->title }}</h3>

            <div class="text-center" style="margin-bottom: 30px">
                <img src="{{ url('storage/news/'.$data->featured_img) }}">
            </div>

            <?php echo $data->description; ?>

            @if(!empty($files))
            <div>
                <p class="text-uppercase" style="margin-left: -15px;font-weight:bold;font-size:16px">REFERENCE FILES</p>
                @foreach($files as $file)
                    @if(in_array($file->type, array('pdf', 'jpeg', 'jpg', 'png')))
                        <div><a href="{{route('view_file', $file->id)}}" target="_blank">{{$file->name}}</a></div>
                    @elseif($file->type === 'mp4')
                        {{--<video width="320" height="240" controls>
                            <source src="{{URL::asset("/storage/app/public/questions/".$item->id.'/'.$file->name)}}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>--}}

                        {!! $file->path !!}
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <br><br>
@endsection
