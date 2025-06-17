@extends('layouts.dashboard')

@section('content')
@include('components.alert')
<section class="section">
    <div class="section-body">
        <div class="card shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0 text-primary">
                    List of Applicant
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-folder-open"></i> List of Applicants
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

    <div class="section-body">
        <div class="card shadow-lg card-primary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bold mb-0">
                    List of applicants
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive table-invoice">
                    <table id="children-table" class="table table-hover text-center">
                        <thead class="table-primary border border-black">
                            <tr>
                                @foreach ($columns as $column)
                                <th class="text-uppercase">
                                    {{ $column }}
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($childrens as $record)
                            <tr>
                                <td class="border border-black">{{ $record->id }}</td>
                                <td class="border border-black">{{ trim($record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name) }}
                                </td>
                                <td class="border border-black">{{ $record->created_at }}</td>
                                <td class="border border-black">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route(Auth::user()->getRoleNames()->first() . '.children.profile', Auth::user()->id) }}">
                                            <button type="button" class="btn btn-sm btn-primary">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                        </a>
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
</section>
@push('scripts')
<script>
$(document).ready(function() {
    $('#children-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        order: [
            [0, 'desc']
        ],

        dom: '<"d-flex justify-content-between align-items-center mb-3"' +
            '<"dataTables_length"l><"dataTables_filter"f>' +
            '>rt' +
            '<"d-flex justify-content-between align-items-center mt-3"' +
            '<"dataTables_info"i><"dataTables_paginate"p>' +
            '>',
        initComplete() {
            $('div.dataTables_length select')
                .removeClass()
                .addClass('form-select form-select-sm border-bottom');
            $('div.dataTables_filter input')
                .removeClass()
                .addClass('form-control form-control-sm')
                .attr('placeholder', 'Search...');
        },
    });
});
</script>
@endpush
@endsection