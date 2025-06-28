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
        </div>
    </div>
    <form action="{{ route(Auth::user()->getRoleNames()->first() . '.educational.store', $child->id) }}" method="POST">
        @csrf
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
                                            <td class="border border-dark" rowspan="{{ $rowCount }}">{{ $goal->name }}
                                            </td>
                                            @endif
                                            <td class="border border-dark">{{ $obj->name }}</td>
                                            <td class="border border-dark">{{ $obj->name }}</td>
                                            <td class="border border-dark">
                                                <div class="form-group">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        @foreach ($ratings as $r)
                                                        <div class="custom-control custom-radio mr-3">
                                                            <input type="radio" id="rating_{{ $obj->id }}_{{ $r->id }}"
                                                                name="ratings[{{ $obj->id }}]" value="{{ $r->id }}"
                                                                class="custom-control-input"
                                                                {{ isset($educPlan[$obj->id]) && $educPlan[$obj->id] == $r->id ? 'checked' : '' }}>
                                                            <label class="custom-control-label"
                                                                for="rating_{{ $obj->id }}_{{ $r->id }}">
                                                                {{ $r->name }}
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
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
    </form>
</section>
@endsection