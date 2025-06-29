@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    Progress report
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a
                                href="{{ route(Auth::user()->getRoleNames()->first() . '.children.profile', $child->id) }}">
                                <i class="fas fa-user-circle"></i> Child Profile
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-list-check"></i> Progress report
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="callout callout-info shadow-sm">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-info-circle fa-lg text-info mr-2"></i>
                        <h5 class="mb-0 text-info">Legend Descriptions</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead class="bg-primary text-center">
                                <tr class="text-white">
                                    <th style="width: 30%">Rating</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ratings as $r)
                                <tr>
                                    <td class="text-center font-weight-bold">{{ $r->name }}</td>
                                    <td>{{ $r->remarks }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-info-circle fa-lg text-info mr-2"></i>
                        <h5 class="mb-0 text-info">Learner's Info</h5>
                    </div>

                    <p class="mb-0"><strong>Name:</strong>
                        {{ trim($child->first_name . ' ' . $child->middle_name . ' ' . $child->last_name) }}</p>
                    <p class="mb-0"><strong>Age:</strong>
                        {{ \Carbon\Carbon::parse($child->birth_date)->diff(\Carbon\Carbon::now())->format('%y years and %m months') }}
                    </p>
                    <p class="mb-0"><strong>Diagnosis:</strong>
                        {{ Str::title($child->disability->disability->name ?? 'N/A') }}
                    </p>
                    <p class="mb-0"><strong>Program:</strong>
                        -
                    </p>
                </div>
            </div>
        </div>
        <form action="{{ route(Auth::user()->getRoleNames()->first() . '.progress.store', $child->id) }}" method="POST">
            @csrf
            <div class="section-body">
                @foreach ($domains as $d)
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card card-primary shadow">
                            <div class="card-body">
                                <div class="card-header justify-content-center">
                                    <h4 class="text-center mb-0">
                                        Learning domain: {{ $d->name ?? '' }}
                                    </h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover border border-dark">
                                        <thead class="table-danger text-white">
                                            <tr>
                                                <th class="border border-dark text-center">Learning Competency</th>
                                                <th class="border border-dark text-center">Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($d->learningCompetency as $lc)
                                            <tr>
                                                <td class="border border-dark">{{ $lc->name ?? '' }}</td>
                                                <td class="border border-dark text-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            @foreach ($ratings as $r)
                                                            <div class="custom-control custom-radio mr-3">
                                                                <input type="radio"
                                                                    id="rating_{{ $lc->id }}_{{ $r->id }}"
                                                                    name="ratings[{{ $lc->id }}]" value="{{ $r->id }}"
                                                                    class="custom-control-input"
                                                                    {{ isset($progress[$lc->id]) && $progress[$lc->id] == $r->id ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="rating_{{ $lc->id }}_{{ $r->id }}">
                                                                    {{ $r->name }}
                                                                </label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </div>
            </div>
        </form>
</section>
@endsection