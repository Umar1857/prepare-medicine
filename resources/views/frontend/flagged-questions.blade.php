@extends('frontend.master-frontend')
@section('js-css')
    <style>
    body{
        background-color:#F4F1EC;
    }
        .panel-white{
            background: white;
            padding: 30px;
        }
        .btn-left{
            float: right;
        }
        .btn{
            padding: 5px 15px;
            border-radius: 4px;
            margin-top:2px;
            margin-right:2px;
            width:45px;
        }

        .delete{
            background-color: red;
        }

    </style>
@endsection
@section('content')
<br>
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Flagged Questions</p>
            </div>
        </div>

    </div>

    <div class="container">
       <div class="panel panel-white">
            <div class="panel-heading clearfix">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px;">Flagged Questions</h2>
            <p class="text-center">
        You can flag questions and return to them later
    </p>
            </div>
            <br>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=>$item)
                                <tr>
                                    <th scope="row">{{ $data->firstItem()+$key }}</th>
                                    <td><strong>{!! $item->flag_question->question !!}</strong?</td>
                                    <td>
                                        <a title="View" class="btn" href="{{ url('q-bank/flag/question/'.$item->ques_id) }}" ><i class="fas fa-eye"></i></a>
                                        <a title="Remove" class="btn delete" href="{{ url('q-bank/drop/flag/'.$item->id) }}"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <span>{{ $data->links() }}</span>
            </div>
        </div>
    </div>
    <br>
@endsection
