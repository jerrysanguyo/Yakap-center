@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    Educational plan
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
                            <i class="fas fa-user-graduate"></i> Educational plan
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="section-body">
        @foreach ($domains as $d)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card card-primary shadow">
                    <div class="card-header justify-content-center">
                        <h4 class="text-center mb-0">
                            {!! strtr($d->remarks ?? '', ['child_name' => trim($child->first_name . ' ' .
                            $child->middle_name . ' ' . $child->last_name)]) !!}
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">
                            <strong>Domain:</strong> {{ $d->name }}<br>
                            <strong>Duration:</strong> In a span of 6–10 months,<br>
                            <strong>Expectation:</strong>
                            {{ trim($child->first_name . ' ' . $child->middle_name . ' ' . $child->last_name) }} is
                            expected to achieve the following:
                        </p>

                        <div class="table-responsive">
                            <table class="table table-hover border border-dark">
                                <thead class="table-danger text-white">
                                    <tr>
                                        <th class="border border-dark">Goal</th>
                                        <th class="border border-dark">Objective</th>
                                        <th class="border border-dark">Accommodation/Intervention</th>
                                        <th class="border border-dark">Level of Prompt Given</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($d->goal as $goal)
                                    @php
                                    $objectives = $goal->objectives;
                                    $accommodations = $goal->accommodations;
                                    $rowCount = max(count($objectives), 1);
                                    @endphp

                                    @if ($rowCount > 0)
                                    @foreach ($objectives as $i => $obj)
                                    <tr>
                                        @if ($i === 0)
                                        <td  class="border border-dark" rowspan="{{ $rowCount }}">{{ $goal->name }}</td>
                                        @endif

                                        {{-- Objective Name --}}
                                        <td class="border border-dark">{{ $obj->name }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>{{ $goal->name }}</td>
                                        <td colspan="3" class="text-center text-muted">No objectives defined.</td>
                                    </tr>
                                    @endif
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
</section>
@endsection