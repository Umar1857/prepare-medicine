@extends('frontend.master-frontend')
@section('content')

    <div class="container-fluid" style="padding-left: 30px; padding-right: 30px">
        <div class='page_banner_img_common'>
            <img src='/frontend/images/pages-banner.png' class='img-fluid'>
            <div class='overlay__'>
                <p>Your Tickets</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('msg.msg')

                <div class="table-responsive">
                    <div>
                        <a href="{{route('ticket.create')}}" class="btn btn-success mb-4">Create New Ticket</a>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Requested at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($tickets))
                            @foreach ($tickets as $key=>$item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td> <?php echo str_limit($item->description, 40); ?></td>
                                    <td>{{$item->status ? 'Resolved' : 'Pending'}}</td>
                                    <td>{{ $item->created_at->format('d-m-y H:m') }}</td>
                                    {{--<td>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#approvalModal{{ $item->id }}"
                                            style="background: #2B3069; border:none;margin-right: 4px"><i class="fa fa-check"></i>
                                        </button>

                                        <a onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" href="{{ route('subscribers_requests_reject', $item->id) }}"><i class="fa fa-times"></i></a>
                                    </td>--}}
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@endsection
