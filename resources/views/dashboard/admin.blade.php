<main class="flex-1 p-8 overflow-y-auto">
    <section class="section">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Students</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Students per Category</h4>
                        </div>
                        <div class="card-body">
                            42
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Students per Therapy</h4>
                        </div>
                        <div class="card-body">
                            1,201
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>No. of Students Today</h4>
                        </div>
                        <div class="card-body">
                            47
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex align-items-stretch">
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h4>Patients</h4>
                        <div class="card-header-action">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.list.index') }}" class="btn btn-danger">
                                View More <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-hover table-md" id="child-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Patients</th>
                                        <th>Status</th>
                                        <th>Date applied</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($children as $child)
                                    <tr>
                                        <td><a href="#">{{ $child->id_number }}</a></td>
                                        <td class="font-weight-600">
                                            {{ trim($child->first_name.' '.$child->middle_name.' '.$child->last_name) }}
                                        </td>
                                        <td>
                                            <div class="badge badge-warning">Sample</div>
                                        </td>
                                        <td>{{ $child->created_at }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card card-hero h-100">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-question-circle"></i>
                        </div>
                        <h4>14</h4>
                        <div class="card-description">Upcoming Appointments</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tickets-list">
                            <a href="#" class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Sample</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>Laila Tazkiah</div>
                                    <div class="bullet"></div>
                                    <div class="text-primary">1 min ago</div>
                                </div>
                            </a>
                            <a href="#" class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Sample</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>Rizal Fakhri</div>
                                    <div class="bullet"></div>
                                    <div>2 hours ago</div>
                                </div>
                            </a>
                            <a href="#" class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Sample</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>Syahdan Ubaidillah</div>
                                    <div class="bullet"></div>
                                    <div>6 hours ago</div>
                                </div>
                            </a>
                            <a href="features-tickets.html" class="ticket-item ticket-more">
                                View All <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Barangays</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-title mb-2">DISTRICT 1</div>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    @foreach ($district1 as $d1)
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Hagonoy.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">{{ $d1->name }}</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="col-sm-6 mt-sm-0 mt-4">
                                <div class="text-title mb-2">DISTRICT 2</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    @foreach ($district2 as $d2)
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Western_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">{{ $d2->name }}</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@push('scripts')
<script>
$(document).ready(function() {
    $('#child-table').DataTable({
        processing: true,
        serverSide: false,
        pageLength: 10,
        order: [
            [0, 'asc']
        ],

        dom: '<"d-flex justify-content-between align-items-center mb-1 mt-3 px-3"' +
            '<"dataTables_length"l><"dataTables_filter"f>' +
            '>rt' +
            '<"d-flex justify-content-between align-items-center mt-1 px-3"' +
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