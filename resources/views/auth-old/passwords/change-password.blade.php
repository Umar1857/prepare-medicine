@extends('layouts.app')

@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-left logo_in_pages" style="margin-bottom: 15px">
                <img src="{{ asset('frontend/images/logo/logo-3.png') }}" style="width: 200px">
            </div>

            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
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
                    <form method="POST" action="{{ url('change-password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="re_password" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                                <input id="re_password" type="password" class="form-control" name="confirm_password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn form-control"
                                    style="background-color: #63BA52; color: #fff; border-radius: 3px">
                                    {{ __('Change') }}
                                </button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
