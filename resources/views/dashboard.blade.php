@extends('layouts.dashboard')
@section('content')
@section('breadcrumb')
<x-breadcrumb :items="[]" />
@endsection

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
                            <a href="#" class="btn btn-danger">
                                View More <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>Patients ID</th>
                                        <th>Patients</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV-87239</a></td>
                                        <td class="font-weight-600">Kusnadi</td>
                                        <td>
                                            <div class="badge badge-warning">Sample</div>
                                        </td>
                                        <td>July 19, 2018</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV-48574</a></td>
                                        <td class="font-weight-600">Hasan Basri</td>
                                        <td>
                                            <div class="badge badge-success">Sample</div>
                                        </td>
                                        <td>July 21, 2018</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV-76824</a></td>
                                        <td class="font-weight-600">Muhamad Nuruzzaki</td>
                                        <td>
                                            <div class="badge badge-warning">Sample</div>
                                        </td>
                                        <td>July 22, 2018</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV-84990</a></td>
                                        <td class="font-weight-600">Agung Ardiansyah</td>
                                        <td>
                                            <div class="badge badge-warning">Sample</div>
                                        </td>
                                        <td>July 22, 2018</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="#">INV-87320</a></td>
                                        <td class="font-weight-600">Ardian Rahardiansyah</td>
                                        <td>
                                            <div class="badge badge-success">Sample</div>
                                        </td>
                                        <td>July 28, 2018</td>
                                        <td>
                                            <a href="#" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
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
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Hagonoy.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Hagonoy</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Ibayo-Tipas.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Ibayo Tipas</div>
                                            <div class="text-small text-muted">3,182 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Ligid-Tipas.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Ligid Tipas</div>
                                            <div class="text-small text-muted">2,317 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Napindan-Tipas.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Napindan Tipas</div>
                                            <div class="text-small text-muted">2,317 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Palingon-Tipas.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Palingon Tipas</div>
                                            <div class="text-small text-muted">2,317 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Santa_Ana.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Santa Ana</div>
                                            <div class="text-small text-muted">2,317 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Ususan.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Ususan</div>
                                            <div class="text-small text-muted">2,317 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Wawa.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Wawa</div>
                                            <div class="text-small text-muted">3,282 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/San_Miguel.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">San Miguel</div>
                                            <div class="text-small text-muted">3,282 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/New_Lower_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">New Lower Bicutan</div>
                                            <div class="text-small text-muted">3,282 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Lower_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Lower Bicutan</div>
                                            <div class="text-small text-muted">3,282 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Bagumbayan.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Bagumbayan</div>
                                            <div class="text-small text-muted">3,282 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Bambang.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Bambang</div>
                                            <div class="text-small text-muted">2,976 <i
                                                    class="fas fa-caret-down text-danger"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Calzada-Tipas.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Calzada Tipas</div>
                                            <div class="text-small text-muted">1,576 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-6 mt-sm-0 mt-4">
                                <div class="text-title mb-2">DISTRICT 2</div>
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Western_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Western Bicutan</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Upper_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Upper Bicutan</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Tanyag.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Tanyag</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Pinagsama.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Pinagsama</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/North_Signal.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">North Signal</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/South_Signal.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">South Signal</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/North_Daang_Hari.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">North Daanghari</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/South_Daang_Hari.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">South Daanghari</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Maharlika.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Maharlika</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Katuparan.png" alt="image"
                                            width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Katuparan</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Central_Bicutan.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Central Bicutan</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Central_Signal.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Central Signal</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                    <li class="media">
                                        <img class="img-fluid mt-1 img-shadow" src="images/Fort_Bonifacio.png"
                                            alt="image" width="40">
                                        <div class="media-body ml-3">
                                            <div class="media-title">Fort Bonifacio</div>
                                            <div class="text-small text-muted">3,486 <i
                                                    class="fas fa-caret-up text-success"></i></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection