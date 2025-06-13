@extends('layouts.dashboard')

@section('content')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-primary">
                    Child Profile
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-user-circle"></i> Child Profile
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-3">
                <div class="card profile-widget">
                    <div class="profile-widget-header text-center py-4">
                        <img alt="Profile Picture"
                            src="{{ asset(Auth::user()->child->first()->files->where('remarks', 8)->first()->file_path) }}"
                            class="rounded-circle profile-widget-picture mb-3">
                        <h3 class="mb-1 font-weight-bold">
                            {{ Str::title(trim(Auth::user()->child->first()->first_name . ' ' . Auth::user()->child->first()->middle_name . ' ' . Auth::user()->child->first()->last_name)) }}
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Emergency Contact</h5>
                            <p class="mb-1">
                                {{ Auth::user()->child->first()->emergency->name }}
                                <span
                                    class="text-muted">({{ Auth::user()->child->first()->emergency->contact_number }})</span>
                            </p>
                            <p class="mb-0">{{ Auth::user()->child->first()->emergency->relationship->name }}</p>
                        </div>
                        <a href="#" class="btn btn-outline-primary btn-block mb-2">View Progress Report</a>
                        <a href="#" class="btn btn-outline-secondary btn-block">View Educational Plan</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Student Identification Card</h4>
                    </div>
                    <div class="card-body text-center">
                        <!-- Generated ID‐card image -->
                        <img src="{{ asset('images/generated/'.$generatedFilename) }}" alt="Child Front ID"
                            class="img-fluid mb-2" style="max-width: 300px;">

                        <!-- If you still want the plain ID number below: -->
                        <p class="mb-0 font-weight-bold">
                            {{ $child->id_number }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-12 col-lg-9">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="mb-0">Personal Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3">
                                        <i class="fas fa-map-marker-alt mr-2 text-primary"></i>
                                        <strong>Residential Address:</strong>
                                        {{ trim(Auth::user()->child->first()->house_number . ', ' . Auth::user()->child->first()->barangay->name . ', ' . Auth::user()->child->first()->city) }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-venus-mars mr-2 text-primary"></i>
                                        <strong>Gender:</strong>
                                        {{ Str::title(Auth::user()->child->first()->gender->name) }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-birthday-cake mr-2 text-primary"></i>
                                        <strong>Date of Birth:</strong>
                                        {{ \Carbon\Carbon::parse(Auth::user()->child->first()->birth_date)->format('F j, Y') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-hourglass-half mr-2 text-primary"></i>
                                        <strong>Current Age:</strong>
                                        {{ \Carbon\Carbon::parse(Auth::user()->child->first()->birth_date)->age }} years
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-school mr-2 text-primary"></i>
                                        <strong>Educational Placement:</strong>
                                        {{ Str::title(Auth::user()->child->first()->education->education->name) }}
                                        — {{ Str::title(Auth::user()->child->first()->education->school) }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-concierge-bell mr-2 text-primary"></i>
                                        <strong>Support Services:</strong>
                                        {{ Auth::user()->child->first()->service->pluck('answer')->contains('Oo') ? 'Yes' : 'No' }}

                                        @if($provided =
                                        Auth::user()->child()->first()->service->where('answer','Oo')->pluck('service.name')->implode(',
                                        '))
                                        <div class="mt-1">
                                            <strong>Service Provider(s):</strong> {{ $provided }}
                                        </div>
                                        @elseif($reasons =
                                        Auth::user()->child()->first()->service->where('answer',
                                        'Hindi')->pluck('service.name')->implode(', '))
                                        <div class="mt-1">
                                            <strong>Reason(s) for Non-Provision:</strong> {{ $reasons }}
                                        </div>
                                        @endif

                                        @if($others =
                                        Auth::user()->child->first()->service->pluck('others')->filter()->implode(', '))
                                        <div class="mt-1">
                                            <strong>Additional Notes:</strong> {{ $others }}
                                        </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3">
                                        <i class="fas fa-wheelchair mr-2 text-primary"></i>
                                        <strong>Disability Details:</strong>
                                        {{ Str::title(Auth::user()->child->first()->disability->disability->name) }}
                                        (PWD ID: {{ Auth::user()->child->first()->disability->pwd_id }})
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-stethoscope mr-2 text-primary"></i>
                                        <strong>Under Regular Medical Review?</strong>
                                        {{ Str::ucfirst(Auth::user()->child->first()->medicalHistory->check_up) }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-tint mr-2 text-primary"></i>
                                        <strong>Blood Type:</strong>
                                        {{ Str::upper(Auth::user()->child->first()->medicalHistory->bloodType->name) }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-prescription-bottle-alt mr-2 text-primary"></i>
                                        <strong>Current Medications:</strong>
                                        {{ Auth::user()->child->first()->medicine->pluck('medicine')->map(fn($m)=>Str::title($m))->implode(', ') }}
                                    </li>
                                    <li class="mb-3">
                                        <i class="fas fa-allergies mr-2 text-primary"></i>
                                        <strong>Known Allergies:</strong>
                                        {{ Auth::user()->child->first()->allergy->pluck('allergy')->map(fn($a)=>Str::title($a))->implode(', ') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md text-center">
                                        <thead>
                                            <tr>
                                                <th>Relation</th>
                                                <th>Full Name</th>
                                                <th>Date of Birth</th>
                                                <th>Facebook Profile</th>
                                                <th>Place of Birth</th>
                                                <th>Email Address</th>
                                                <th>Educational Attainment</th>
                                                <th>Workplace</th>
                                                <th>Contact Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Mother</td>
                                                <td>{{ $motherInfo->name ?? 'N/A' }}</td>
                                                <td>{{ $motherInfo->birth_date ?? 'N/A' }}</td>
                                                <td><a href="{{ $motherInfo->fb_account }}" target="_blank"><i
                                                            class="fab fa-facebook mr-1"></i>View Profile</a></td>
                                                <td>{{ Str::title($motherInfo->birth_place ?? 'N/A') }}</td>
                                                <td>{{ $motherInfo->email ?? 'N/A' }}</td>
                                                <td>{{ Str::title($motherInfo->education->name ?? 'N/A') }}</td>
                                                <td>{{ Str::title($motherInfo->work_place ?? 'N/A') }}</td>
                                                <td>{{ $motherInfo->contact_number ?? 'N/A' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Father</td>
                                                <td>{{ $fatherInfo->name ?? 'N/A' }}</td>
                                                <td>{{ $fatherInfo->birth_date ?? 'N/A' }}</td>
                                                <td><a href="{{ $fatherInfo->fb_account }}" target="_blank"><i
                                                            class="fab fa-facebook mr-1"></i>View Profile</a></td>
                                                <td>{{ Str::title($fatherInfo->birth_place ?? 'N/A') }}</td>
                                                <td>{{ $fatherInfo->email ?? 'N/A' }}</td>
                                                <td>{{ Str::title($fatherInfo->education->name ?? 'N/A') }}</td>
                                                <td>{{ Str::title($fatherInfo->work_place ?? 'N/A') }}</td>
                                                <td>{{ $fatherInfo->contact_number ?? 'N/A' }}</td>
                                            </tr>
                                            @foreach ($family as $f)
                                            <tr>
                                                <td>{{ $f->relationship->name ?? 'N/A' }}</td>
                                                <td>{{ $f->full_name ?? 'N/A' }}</td>
                                                <td>{{ $f->birth_date ?? 'N/A' }}</td>
                                                @if (!empty($f->fb_account))
                                                <td><a href="{{ $f->fb_account }}" target="_blank">
                                                        <i class="fab fa-facebook mr-1"></i>View Profile</a></td>
                                                @else
                                                <td>N/A</td>
                                                @endif
                                                <td>{{ Str::title($f->birth_place ?? 'N/A') }}</td>
                                                <td>{{ $f->email ?? 'N/A' }}</td>
                                                <td>{{ Str::title($f->education->name ?? 'N/A') }}</td>
                                                <td>{{ Str::title($f->work_place ?? 'N/A') }}</td>
                                                <td>{{ $f->contact_number ?? 'N/A' }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection