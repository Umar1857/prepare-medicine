@extends('backend.master-backend')
@section('js-css')
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


        .fa-remove{
            color: #fff !important
        }

    </style>
@endsection
@section('content')

    <div class="panel panel-white">
        <div class="panel-heading clearfix">
            <h4 class="panel-title">Subscription Plans</h4>
        </div>

        @if(auth()->user()->can('Create Subscription Plan'))
            <div class="panel-heading clearfix btn-left">
                <a href="{{ route('subscriptions.create') }}" class="btn btn-sencodary">Add Subscription Plan</a>
            </div>
        @endif

        <br><br>
        <div class="panel-body">
            @include('msg.msg')
            <div class="table-responsive">
                <table class="table table-bordered data_table">
                    <thead>
                    <tr>
                        <th>Name</th>
{{--                        <th>Description</th>--}}
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                            <td >{{ $plan->name }}</td>
{{--                            <td ><?php echo str_limit($plan->description, 50); ?></td>--}}
                            <td >{{ $plan->price }}</td>
                            <td >{{ $plan->status ? 'Active' : 'Disabled' }}</td>
                            <td>
                                @if(auth()->user()->can('Edit Subscription Plan'))
                                    <a href="{{ route('subscriptions.edit', $plan->id) }}" style="background-color: #0A68D4; color: #fff; border: none;" class="btn btn-sm"><i class="fa fa-edit edit"></i></a>
                                @endif

                                @if(auth()->user()->can('Delete Subscription Plan'))
                                    <form method="post" class="delete-form" action="{{ route('subscriptions.destroy', $plan->id) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" style="background-color: red; color: #fff; border: none;" class="btn btn-sm delete-submit-btn"><i class="fa fa-remove"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
{{--            <span>{{ $plans->render() }}</span>--}}
        </div>
    </div>


@endsection
