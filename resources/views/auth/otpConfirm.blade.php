@extends('layouts.auth.login')
@section('content')
@include('components.alert')
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('images/logoyakap.webp') }}" alt="logo" width="100"
                            class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <div class="text-center w-100">
                                <h4 class="mb-1">OTP Verification</h4>
                                <span class="text-muted small">Please enter the otp that was sent to your contact number
                                    and email address</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('otp.confirm', $user->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="otp">OTP</label>
                                    <input id="otp" type="text" class="form-control" name="otp" tabindex="1" required
                                        autofocus>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                        Verify OTP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        Copyright © 2025 <div class="bullet"></div> Information Technology
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection