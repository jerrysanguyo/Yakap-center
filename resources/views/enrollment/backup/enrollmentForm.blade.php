@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-header">
        <h1>Enrollment Forms</h1>
    </div>

    <div class="section-body">
        <h2 class="section-title">Multi‐Step Enrollment</h2>
        <p class="section-lead">
            Complete each section in order to finish the enrollment.
        </p>

        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills d-flex justify-content-between w-100" id="enrollmentTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-child" data-toggle="pill" href="#pane-child" role="tab"
                            aria-controls="pane-child" aria-selected="true">
                            Child’s Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-guardian" data-toggle="pill" href="#pane-guardian" role="tab"
                            aria-controls="pane-guardian" aria-selected="false">
                            Guardian Information
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-disability" data-toggle="pill" href="#pane-disability" role="tab"
                            aria-controls="pane-disability" aria-selected="false">
                            Disability Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-education" data-toggle="pill" href="#pane-education" role="tab"
                            aria-controls="pane-education" aria-selected="false">
                            Educational Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-service" data-toggle="pill" href="#pane-service" role="tab"
                            aria-controls="pane-service" aria-selected="false">
                            Service Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-medical" data-toggle="pill" href="#pane-medical" role="tab"
                            aria-controls="pane-medical" aria-selected="false">
                            Medical Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-family" data-toggle="pill" href="#pane-family" role="tab"
                            aria-controls="pane-family" aria-selected="false">
                            Family Composition
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-emergency" data-toggle="pill" href="#pane-emergency" role="tab"
                            aria-controls="pane-emergency" aria-selected="false">
                            Emergency Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="enrollmentTabsContent">
                    <div class="tab-pane fade show active" id="pane-child" role="tabpanel" aria-labelledby="tab-child">
                        <h4 class="font-weight-bold mb-4">Child’s Information</h4>
                        @include('enrollment.partial.ChildInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-guardian" role="tabpanel" aria-labelledby="tab-guardian">
                        <h4 class="font-weight-bold mb-4">Guardian Information</h4>
                        @include('enrollment.partial.GuardianInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-disability" role="tabpanel" aria-labelledby="tab-disability">
                        <h4 class="font-weight-bold mb-4">Disability Details</h4>
                        @include('enrollment.partial.DisabilityInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-education" role="tabpanel" aria-labelledby="tab-education">
                        <h4 class="font-weight-bold mb-4">Educational Details</h4>
                        @include('enrollment.partial.EducationalInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-service" role="tabpanel" aria-labelledby="tab-service">
                        <h4 class="font-weight-bold mb-4">Service Details</h4>
                        @include('enrollment.partial.ServiceInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-medical" role="tabpanel" aria-labelledby="tab-medical">
                        <h4 class="font-weight-bold mb-4">Medical Details</h4>
                        @include('enrollment.partial.MedicalInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-family" role="tabpanel" aria-labelledby="tab-family">
                        <h4 class="font-weight-bold mb-4">Family Composition</h4>
                        @include('enrollment.partial.FamilyInfo')
                    </div>

                    <div class="tab-pane fade" id="pane-emergency" role="tabpanel" aria-labelledby="tab-emergency">
                        <h4 class="font-weight-bold mb-4">Emergency Contact</h4>
                        @include('enrollment.partial.EmergencyInfo')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection