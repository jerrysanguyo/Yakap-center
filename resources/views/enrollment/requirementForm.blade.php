@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    Requirements
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
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.enrollment.index') }}">
                                <i class="fas fa-file-alt"></i> Enrollment Form
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-paperclip"></i> Requirements
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <div class="callout-header">
                        <i class="fas fa-info-circle text-info"></i> Note
                    </div>
                    <p class="mb-0">
                        Para sa katanungan, bisitahin ang aming
                        <a href="https://www.facebook.com/TaguigYakapCenter" target="_blank">FB Page</a>
                        o tumawag sa <strong>0993-271-3283</strong> / <strong>0908-306-0687</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex align-items-center">
                <h3 class="font-weight-bold mb-0">
                    List of Requirements
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ route(Auth::user()->getRoleNames()->first() . '.requirement.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Requirement</th>
                                    <th class="text-center">Upload File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($requirements as $r)
                                @php
                                $existing = $existingFiles->get($r->id);
                                @endphp
                                <tr>
                                    <td>
                                        <i class="fas fa-chevron-right text-primary mr-1"></i>
                                        {{ $r->name }}
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="d-flex align-items-center justify-content-center">
                                            @if($existing)
                                            <a href="{{ asset($existing->file_path) }}" target="_blank"
                                                class="badge badge-info mr-3">
                                                <i class="fas fa-file-download"></i>
                                                {{ $existing->file_name }}
                                            </a>
                                            @endif
                                            <div class="input-group input-group-sm w-auto">
                                                <input type="text" id="filename-{{ $r->id }}" class="form-control"
                                                    placeholder="No file chosen" readonly>
                                                <button class="btn btn-primary" type="button"
                                                    onclick="document.getElementById('file-{{ $r->id }}').click()">
                                                    <i class="fas fa-folder-open mr-1"></i>Browse
                                                </button>
                                                <input type="file" id="file-{{ $r->id }}"
                                                    name="requirements[{{ $r->id }}]" class="d-none"
                                                    onchange="document.getElementById('filename-{{ $r->id }}').value = this.files[0]?.name || 'No file chosen';">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right bg-white">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane mr-1"></i> Submit Requirements
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection