@extends('frontend.master-frontend')
@section('js-css')

    <style>
        .user-name{
            color:#63BA52;
            display: ruby;
        }
        .user-feedback{
            margin: 25px 0;
        }
        .edit-btn{
            color: green;
        }
        .well h4{
            border-bottom: 3px solid #ddd;
            padding-bottom: 10px
        }
        .notificationsArea table tr th,
        .notificationsArea table tr td{
            border: none;
        }

        .subscribe_button{
            background: #55BA5D !important;
            border-radius: 5px !important;
            font-weight: normal;
        }
        .subscribe_button:hover{
            box-shadow: 1px 4px 7px 2px #777;
            transform: scale(1.1);
            transition: .8s
        }
    </style>

@endsection
@section('content')
<br>

    {{--  data fetch from Database !!  --}}
    
    <div class="container-fluid">
        <div class='page_banner_img_common'>
            <div class='overlay__'>
                <p>Notifications</p>
            </div>
        </div>
        <div class="container">
        <div class="row my-4 my-md-5 justify-content-center" style="padding-left: 45px; padding-right: 45px">
            <div class="well" style="width:100%">
            <h2 class="text-center mt-4 mb-sm-5 mb-4" style="font-size: 36px">Notifications</h2>
                <br>
               @foreach ($data as $item)
                    <div class="list-group">
                        <div class="col-md-12">
                            <h5 class="list-group-item-heading  user-name" data-toggle="collapse" data-target="#desc{{ $item->id }}" style="cursor:pointer"><b>{{ $item->title }}</b>, at {{ $item->created_at->format('d M Y') }}, from {{ $item->noti_from }}</h5>
                            <div class="alert alert-info alert-dismissible list-group-item-text user-feedback collapse" id="desc{{ $item->id }}" style="background:rgb(245, 245, 245); border: 1px solid azure;">
                                <p class="" > {!! $item->description !!} </p>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach


                @if(Auth::user()->expeir_date < date('Y-m-d'))
                <div style="border-top:1px solid #ddd">
                    <div class="col-md-12">
                        <div class="notificationsArea">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>Your Subscription Plan</th>
                                            <td>
                                                @if(Auth::user()->role == 2)
                                                    {{ 'Trial' }}
                                                @elseif(Auth::user()->role == 3)
                                                    {{ 'Refugees Doctors' }}
                                                @elseif(Auth::user()->role == 5)
                                                    {{ 'Basic' }}
                                                @elseif(Auth::user()->role == 6)
                                                    {{ 'Standard' }}
                                                @elseif(Auth::user()->role == 7)
                                                    {{ 'Advance' }}
                                                @elseif(Auth::user()->role == 8)
                                                    {{ 'Professional' }}
                                                @else
                                                    {{ 'Something wrong' }}
                                                @endif
                                            </td>
                                            
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <th>
                                                <span style="color: red">{{ 'Expired' }}</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Expired Date</th>
                                            <th>{{ date('d F Y', strtotime(Auth::user()->expeir_date)) }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <a class="subscribe_button btn btn-sm" href="{{ route('root_page') }}#most_popular_courses">UPGRADE PLAN</a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            </div>
        </div>
    </div>
    <br>
@endsection
