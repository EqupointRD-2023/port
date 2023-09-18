<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMS</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="icon" type="image/png" href="{{ asset('logo/EQU_ICON(16-16).png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="">
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">EMS</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav">
                        @can('tag-list')
                            <a href="{{ route('home-port') }}" class="nav-item nav-link active">DASHBOARD</a>

                            <a href="{{ route('requsition-port') }}" class="nav-item nav-link active">REQUISITION</a>
                            <a href="{{ route('receiveDevice') }}" class="nav-item nav-link ">RECEIVE DEVICE</a>
                            <a href="{{ route('stock-port') }}" class="nav-item nav-link "> MY STOCK</a>
                            <a href="#" class="nav-item nav-link "> TRANSFER DEVICE</a>
                            <a href="{{ route('lease') }}" class="nav-item nav-link ">LEASING </a>
                            <a href="{{ route('lease-history') }}" class="nav-item nav-link ">LEASING HISTORY</a>
                            <a href="{{ route('lease-report-port') }}" class="nav-item nav-link ">LEASING REPORT</a>
                        @endcan

                        @can('untag-list')
                            <a href="" class="nav-item nav-link "> DASHBOARD </a>

                            <a href="" class="nav-item nav-link ">KUPOKEA DEVICE</a>

                            <a href="" class="nav-item nav-link ">STOCK YANGU</a>
                        @endcan
                        <!-- <a href="#" class="nav-item nav-link">Profile</a> -->
                        <!-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Messages</a>
                        <div class="dropdown-menu">
                            <a href="#" class="dropdown-item">Inbox</a>
                            <a href="#" class="dropdown-item">Sent</a>
                            <a href="#" class="dropdown-item">Drafts</a>
                        </div>
                    </div> -->
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Logout</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav> --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">EMS</a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav">
                        <a href="{{ route('home-port') }}" class="nav-item nav-link active">DASHBOARD</a>
                        <a href="{{ route('requsition-port') }}" class="nav-item nav-link active">REQUISITION</a>
                        <a href="{{ route('receiveDevice') }}" class="nav-item nav-link ">RECEIVE DEVICE</a>
                        <a href="{{ route('stock-port') }}" class="nav-item nav-link "> MY STOCK</a>
                        <a href="{{ route('lease') }}" class="nav-item nav-link ">LEASING </a>
                        <a href="{{ route('lease-history') }}" class="nav-item nav-link ">LEASING HISTORY</a>
                        <a href="{{ route('lease-report-port') }}" class="nav-item nav-link ">LEASING REPORT</a>
                        {{-- <a href="{{ route('report-all') }}" class="nav-item nav-link ">REPORT</a> --}}
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Logout</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="content">


            {{-- @include('flash-message') --}}

            @yield('content')


        </div>
    </div>
    <script src="{{ asset('backend_2/assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('backend_2/assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('backend_2/assets/vendors/chart.js/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('backend_2/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript">
    </script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('backend_2/assets/js/app.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('backend_2/assets/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/select2/dist/js/select2.full.min.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('backend_2/assets/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>

    <script src="{{ asset('backend_2/assets/vendors/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/vendors/jquery-minicolors/jquery.minicolors.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('backend_2/assets/js/scripts/form-plugins.js') }}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
</body>

</html>
