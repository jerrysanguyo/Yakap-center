@extends('layouts.auth.login')
@section('content')
@include('components.alert')
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div
                    class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img src="{{ asset('images/logoyakap.webp') }}" alt="logo" width="100"
                            class="shadow-light rounded-circle">
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('registration.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                            autofocus>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input id="middle_name" type="text" class="form-control" name="middle_name">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" type="text" class="form-control" name="last_name">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="contact_number">Contact number</label>
                                        <input id="contact_number" type="text" class="form-control" name="contact_number">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="text" class="form-control pwstrength"
                                            data-indicator="pwindicator" name="password">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password_confirmation" class="d-block">Password Confirmation</label>
                                        <input id="password_confirmation" type="text" class="form-control"
                                            name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger btn-lg btn-block">
                                        Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="mt-5 text-muted text-center">
                        Already have an account? <a href="{{ route('login.index') }}">Log in</a>
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