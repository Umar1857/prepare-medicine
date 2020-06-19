@extends('frontend.master-frontend')
@section('js-css')

    <style>
        .user-name{
            color:red;
            display: ruby;
        }
        .user-feedback{
            margin-left: 25px;
        }
        .edit-btn{
            color: green;
        }
    </style>

@endsection
@section('content')
<br>

    {{--  data fetch from Database !!  --}}
    <br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Feedback</p>
            </div>
        </div>
        
        <div class="row">
            <div class="well">
                <h2 class="text-center mb-5">Feedback</h2>
                <br>
                @foreach ($data as $item)
                    <div class="list-group">
                        <div class="col-md-12">
                            <h4 class="list-group-item-heading  user-name">
                                {{ $item->user_name }}
                                @isset(Auth::user()->role)
                                    @if ($item->user_id == Auth::user()->id)
                                        <a href="{{ url('our-team/feedback/edit/'.$item->id ) }}"><i class="fa fa-edit edit-btn"></i></a>
                                        <a href="{{ url('feedback/drop/'.$item->user_id.'/'.$item->id) }}"><i class="fa fa-remove"></i></a>
                                    @endif
                                @endif
                            </h4>
                            <p class="list-group-item-text user-feedback"> {{ $item->feedback }} </p>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
        <br>
        <span>
            {{ $data->links() }}
        </span>

        @isset(Auth::user()->role)
            @if (Auth::user()->role >= 2)
                <br><br><br><br><br>
                <form action="{{ url('feedback/insert') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <div class="row">
                            <div class="form-control col-12">
                                <label for="exampleFormControlTextarea6"> Write your opinion about Us </label>
                                <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3" placeholder="Write something here..." name="feedback"></textarea>
                            </div>
                    </div>
                    <br>
                    <input type="submit" value="Place a Feedback" class="form-control btn btn-info col-12" style="background:green"">
                </form>
            @endif
        @endisset

    </div>
    <br>
@endsection
