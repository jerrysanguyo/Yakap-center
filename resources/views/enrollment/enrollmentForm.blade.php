@extends('layouts.dashboard')

@section('content')
@include('components.alert')
@php
$selectedDistrict = old('district_id', $childInfo->district_id ?? '');
$selectedBarangay = old('barangay_id', $childInfo->barangay_id ?? '');
@endphp
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mb-0 text-primary">Enrollment form</h2>
                    <div class="section-body-breadcrumb d-flex">
                        <div class="breadcrumb-item active">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                Dashboard
                            </a>
                        </div>
                        <div class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.consent.index') }}">
                                Consent form
                            </a>
                        </div>
                        <div class="breadcrumb-item">
                            Enrollment form
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route(Auth::user()->getRoleNames()->first() . '.enrollment.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.Childinfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.DisabilityInfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.EducationalInfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.ServiceInfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.MedicalInfo')
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.GuardianInfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.FamilyInfo')
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @include('enrollment.partial.EmergencyInfo')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
</section>
@endsection