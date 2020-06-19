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
                <p>Feedback Edit</p>
            </div>
        </div>

        @isset(Auth::user()->role)
            @if (Auth::user()->role >= 2)
                <br><br><br><br><br>
                <form action="{{ url('feedback/update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $old_data->id }}">
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    <div class="row">
                            <div class="form-control col-12">
                                <label for="exampleFormControlTextarea6"> Write your opinion about Us </label>
                                <textarea class="form-control z-depth-1" id="exampleFormControlTextarea6" rows="3" placeholder="Write something here..." name="feedback">{{ $old_data->feedback ?? '' }}</textarea>
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
