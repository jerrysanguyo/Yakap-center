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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-primary">
                    Enrollment Form
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.consent.index') }}">
                                <i class="fas fa-file-signature"></i> Consent Form
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-file-alt"></i> Enrollment Form
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <div class="callout-header">
                        <i class="fas fa-info-circle text-danger"></i> Please Note
                    </div>
                    <p class="mb-0">
                        For any field that does not apply, simply input <strong>N/A</strong>.
                    </p>
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