@extends('backend.master-backend')
@section('js-css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <style>
        .panel-white{
            background: white;
            padding: 10px;
        }
        .btn-left{
            float: left;
        }
        .btn-right{
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
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger col-12">{{ $error }}</div>
                    @endforeach
                @endif
                @if (session('error'))
                    <div class="alert alert-danger col-12">{{ session('error') }}</div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success col-12">{{ session('success') }}</div>
                @endif

                <div class="alert alert-info" role="alert">Change Password</div>
                <form method="POST" action="{{ url('change-password') }}">
                    @csrf

                    <div class="form-group">
                        <label for="old_password">{{ __('Old Password') }}</label>

                        <div>
                            <input id="old_password" type="password" class="form-control" name="old_password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new_password">{{ __('New Password') }}</label>

                        <div>
                            <input id="new_password" type="password" class="form-control" name="new_password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="re_password">{{ __('Confirm New Password') }}</label>

                        <div>
                            <input id="re_password" type="password" class="form-control" name="confirm_password">
                        </div>
                    </div>

                    <div class="form-group">
                            <button type="submit" class="btn form-control btn-right"
                                    style="background-color: #63BA52; color: #fff; border-radius: 3px">
                                {{ __('Change') }}
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
