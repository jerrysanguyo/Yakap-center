<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Taguig Yakap Center</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/4f2d7302b1.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

    <!-- Start GA -->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

    <style type="text/css">
    /* Chart.js */
    @-webkit-keyframes chartjs-render-animation {
        from {
            opacity: 0.99
        }

        to {
            opacity: 1
        }
    }

    @keyframes chartjs-render-animation {
        from {
            opacity: 0.99
        }

        to {
            opacity: 1
        }
    }

    .chartjs-render-monitor {
        -webkit-animation: chartjs-render-animation 0.001s;
        animation: chartjs-render-animation 0.001s;
    }
    </style>

    <style type="text/css">
    .jqstooltip {
        position: absolute;
        left: 0px;
        top: 0px;
        visibility: hidden;
        background: rgb(0, 0, 0) transparent;
        background-color: rgba(0, 0, 0, 0.6);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";
        color: white;
        font: 10px arial, san serif;
        text-align: left;
        white-space: nowrap;
        padding: 5px;
        border: 1px solid white;
        z-index: 10000;
    }

    .jqsfield {
        color: white;
        font: 10px arial, san serif;
        text-align: left;
    }
    </style>
</head>

<body class="sidebar-show">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg" style="background-color: rgb(131, 17, 21);"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                                <i class="fas fa-bars"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none">
                                <i class="fas fa-search"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                            data-width="250" style="width: 250px;">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        <div class="search-backdrop"></div>
                        <div class="search-result">
                            <div class="search-header">
                                Histories
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep">
                            <i class="far fa-envelope"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-list-toggle">
                        <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep">
                            <i class="far fa-bell"></i>
                        </a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">
                                Notifications
                                <div class="float-right">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Hi, 
                                @auth
                                {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }} {{ Auth::user()->last_name }}
                                @endauth
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in 5 min ago</div>
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-activities.html" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Taguig Yakap Center</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">St</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="dropdown active">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.dashboard') }}" class="nav-link">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-header">Student</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link">
                                <i class="fas fa-hands-holding-child"></i>
                                <span>Children Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="">
                                <i class="fas fa-list-check"></i>
                                <span>Progress Report</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-graduate"></i>
                                <span>Educational Plan</span>
                            </a>
                        </li>
                        <li class="menu-header">Enrollment</li>
                        <li class="dropdown">
                            <a href="{{ route(Auth::user()->getRoleNames()->first() . '.enrollment.index') }}"
                                class="nav-link">
                                <i class="fas fa-file-alt"></i>
                                <span>Enrollment</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link">
                                <i class="fas fa-paperclip"></i>
                                <span>Requirements</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link">
                                <i class="fas fa-stethoscope"></i>
                                <span>Therapy</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link">
                                <i class="fas fa-file-signature"></i>
                                <span>Consent Forms</span>
                            </a>
                        </li>
                        <li class="menu-header">CMS</li>
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="fas fa-th"></i>
                                <span>Dropdown options</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.blood.index') }}">
                                        <i class="fas fa-droplet"></i>
                                        Blood type
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.civil.index') }}">
                                        <i class="fas fa-id-card"></i>
                                        Civil status
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.disability.index') }}">
                                        <i class="fas fa-wheelchair"></i>
                                        Disability
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.district.index') }}">
                                        <i class="fas fa-map-marked-alt"></i>
                                        District
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.barangay.index') }}">
                                        <i class="fas fa-city"></i>
                                        Barangay
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.education.index') }}">
                                        <i class="fas fa-graduation-cap"></i>
                                        Education
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.gender.index') }}">
                                        <i class="fas fa-venus-mars"></i>
                                        Gender
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.goal.index') }}">
                                        <i class="fas fa-bullseye"></i>
                                        Goal
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.competency.index') }}">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                        Learning Competency
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.domain.index') }}">
                                        <i class="fas fa-book-open"></i>
                                        Learning Domain
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.objective.index') }}">
                                        <i class="fas fa-check-circle"></i>
                                        Objective
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.privacy.index') }}">
                                        <i class="fas fa-user-secret"></i>
                                        Privacy
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.program.index') }}">
                                        <i class="fas fa-code"></i>
                                        Program
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.rating.index') }}">
                                        <i class="fas fa-star"></i>
                                        Rating
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.relation.index') }}">
                                        <i class="fas fa-handshake"></i>
                                        Relation
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link"
                                        href="{{ route(Auth::user()->getRoleNames()->first() . '.service.index') }}">
                                        <i class="fas fa-concierge-bell"></i>
                                        Service
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
                            <i class="fas fa-comment"></i> Contact support
                        </a>
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content" style="min-height: 635px;">
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright © 2018 <div class="bullet"></div> Information Technology
                </div>
                <div class="footer-right">
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraries -->
    <script src="{{ asset('assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/modules/chart.min.js') }}"></script>
    <script src="{{ asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @stack('scripts')
</body>

</html>