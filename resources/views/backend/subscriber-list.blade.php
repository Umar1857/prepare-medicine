@extends('backend.master-backend')
@section('js-css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        .panel-white{
            background: white;
            padding: 10px;
        }
        .btn-left{
            float: right;
        }
        .delete{
            color: red;
            margin-left: 5px;
        }
        .edit , .delete{
            font-size: 25px;
        }
        .edit {
            cursor: pointer;
        }


        .btn_custom_style{
            background-color: #ddd;
            color: #000
        }

    </style>

@endsection
@section('content')
<br>

<div class="panel panel-white">
    <div class="panel-heading clearfix">
        <h4 class="panel-title">Subscriber List</h4>

        <div class='table-responsive'>
            <table class='table text-center'>
                <thead style='background:#ddd'>
                    <tr>
                        <th>Total</th>
                        <th>Trial</th>
                        <th>Refugees</th>
                        <th>Basic</th>
                        <th>Standard</th>
                        <th>Advanced</th>
                        <th>Professional</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ count($data) }}</td>
                        <td>{{ $total_trail }}</td>
                        <td>{{ $total_refugees }}</td>
                        <td>{{ $total_basic }}</td>
                        <td>{{ $total_standard }}</td>
                        <td>{{ $total_advanced }}</td>
                        <td>{{ $total_professional }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <br>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered data_table">
                <thead>
                    <tr>
                        <th>#</th>
{{--                        <th>ID</th>--}}
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Plan</th>
{{--                        <th>Transaction ID</th>--}}
                        <th>Expire Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key=>$item)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
{{--                            <td>{{ $item->customer_id }}</td>--}}
                            <td>{{ $item->f_name }} {{ $item->s_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ \App\country::where('id', $item->country)->pluck('country_name')[0] }}</td>
                            <td>
                                @if($item->role == 2)
                                    {{ 'Trail' }}
                                @elseif($item->role == 3)
                                    {{ 'Refugees Doctors' }}
                                @elseif($item->role == 5)
                                    {{ 'Basic' }}
                                @elseif($item->role == 6)
                                    {{ 'Standard' }}
                                @elseif($item->role == 7)
                                    {{ 'Advance' }}
                                 @elseif($item->role == 8)
                                    {{ 'Professional' }}
                                @else
                                    {{ 'Wrong' }}
                                @endif
                            </td>
{{--                            <td>{{$item->trxID ? $item->trxID : ''}}</td>--}}
                            <td>
                                {{  date('d F Y', strtotime($item->expeir_date)) }}
                            </td>
                            <td>
                                <a href="{{ route('edit_subscriber', $item->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @if($item->status)
                                    <a href="{{ route('subscriber_status', $item->id) }}" style="background-color: red; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-remove edit"></i></a>
                                @else
                                    <a href="{{ route('subscriber_status', $item->id) }}" style="background-color: #1c7430; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-check edit"></i></a>
                                @endif
                                <a href="{{ route('subscriber_delete', $item->id) }}" style="background-color: red; color: #fff; border: none;" class="btn btn-sm delete-btn"><i class="fa fa-trash edit"></i></a>
                            </td>
                        </tr>



                    @endforeach
                </tbody>
            </table>
        </div>
        <span>{!! $data->render() !!}</span>
    </div>
</div>


@endsection
@section('js')

@endsection
