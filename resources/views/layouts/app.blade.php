<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    {{-- <meta http-equiv="refresh" content="{{ config('session.lifetime') * 2 }}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EMS</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/EQU_ICON(16-16).png') }}" />
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('backend_2/assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_2/assets/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_2/assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('backend_2/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('backend_2/assets/css/main.min.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('backend_2/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend_2/assets/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('backend_2/assets/vendors/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('backend_2//assets/vendors/jquery-minicolors/jquery.minicolors.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @livewireStyles
    <style media="screen">
        /* .loading {
        display: flex;
        justify-content: center;
        }

        .loading--full-height {
        align-items: center;
        height: 100%;
        }

        .loading::after {
        content: "";
        width: 50px;
        height: 50px;
        border: 10px solid #dddddd;
        border-top-color: #009579;
        border-radius: 50%;
        transform: rotate(0.16turn);
        animation: loading 1s ease infinite;
        }

        @keyframes loading {
        /* Safari support */
        from {
            transform: rotate(0turn);
        }

        to {
            transform: rotate(1turn);
        }
        }

        */
    </style>

</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="{{ url('/dashboard') }}">
                    <span class="brand">
                        <span class="brand-tip">EMS</span>
                    </span>
                    <span class="brand-mini">EMS</span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li><strong>{{ Auth::user()->name }}</strong></li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            {{-- <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" /> --}}
                            <span></span> <i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:;"><i class="fa fa-support"></i>Support</a>
                            <li class="dropdown-divider">
                            </li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();"><i
                                    class="fa fa-sign-out"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li class="heading">Dashboard</li>

                    <li>
                        <a class="active" href="{{ url('/home') }}"><i class="sidebar-item-icon fa fa-dashboard"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>



                    <li class="heading">Device Management</li>

                    <li>
                        <a class="active" href="{{ route('devices') }}"><i
                                class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Device Register</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a class="active" href=""><i class="sidebar-item-icon fa fa-exchange"></i>
                            <span class="nav-label">Device Transfer</span>
                        </a>
                    </li> --}}


                    <li class="heading">Store Management</li>

                    <li>
                        <a class="" href="{{ route('requsition') }}"><i
                                class="sidebar-item-icon fa fa-folder"></i>
                            <span class="nav-label">Requisition</span>
                        </a>
                    </li>


                    <li>
                        <a class="" href="{{ route('dispatch') }}"><i
                                class="sidebar-item-icon fa fa-folder-open"></i>
                            <span class="nav-label">Dispatch</span>
                        </a>
                    </li>

                    <li>
                        <a class="active" href=""><i class="sidebar-item-icon fa fa-database"></i>
                            <span class="nav-label">Port Stock</span>
                        </a>
                    </li>




                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-task"></i>
                            <span class="nav-label">Receiving Device</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">

                            <li>
                                <a href=""> Border</a>
                            </li>
                            <li>
                                <a href="{{ route('stock-from-port') }}">Port</a>
                            </li>

                        </ul>
                    </li>

                    {{--
                    <li>
                        <a class="active" href=""><i class="sidebar-item-icon fa fa-map"></i>
                            <span class="nav-label">Tracking Device</span>
                        </a>
                    </li> --}}
                    {{-- @can('role-edit')
                        <li>
                            <a class="active" href=""><i class="sidebar-item-icon fa fa-address-book"></i>
                                <span class="nav-label">Receive Shortcut</span>
                            </a>
                        </li>
                    @endcan --}}


                    {{-- <li>
                        <a class="active" href=""><i class="sidebar-item-icon fa fa-search"></i>
                            <span class="nav-label">Quickly Search</span>
                        </a>
                    </li> --}}

                    {{-- <li class="heading">Rotate Management</li> --}}

                    {{-- <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-random"></i>
                            <span class="nav-label">Device Rotate Control</span><i
                                class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">

                            <li>
                                <a href=""> Device location status</a>
                            </li>
                            <li>
                                <a href="">Latest Device Efficiency</a>
                            </li>

                            <li>
                                <a href="#">Device Efficiency Report</a>
                            </li>

                        </ul>
                    </li> --}}

                    {{-- <li>
                        <a class="active" href=""><i class="sidebar-item-icon fa fa-map-marker"></i>
                            <span class="nav-label">Device Maintenace</span>
                        </a>
                    </li> --}}

                    <li class="heading">Reports Management</li>

                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-archive"></i>
                            <span class="nav-label">Report Control</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">


                            <li>
                                <a href=""> Leasing Report</a>
                            </li>

                            <li>
                                <a href="">Issued Report</a>
                            </li>
                            <li>
                                <a href="javascript:;">Receiving Report</a>
                            </li>
                            <li>
                                <a href="">Returned Border Report</a>
                            </li>
                            <li>
                                <a href="">Returned Port Report</a>
                            </li>

                            <li>
                                <a href="">Device Stock Report</a>
                            </li>

                        </ul>
                    </li>

                    <li class="heading">Setting Management</li>

                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-cogs"></i>
                            <span class="nav-label">Setting Control</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">

                            <li>
                                <a href="{{ route('users') }}">Users</a>
                            </li>
                            <li>
                                <a href="{{ route('price') }}">Price</a>
                            </li>
                            <li>
                                <a href="{{ route('customer') }}">Customer</a>
                            </li>
                            {{-- <li>
                                <a href="">Customer</a>
                            </li> --}}
                            <li>
                                <a class="" href="{{ route('departments') }}"> Department</a>
                            </li>
                            {{-- <li>
                                <a href="">Untag Point(Border)</a>
                            </li>
                            <li>
                                <a href="">Team</a>
                            </li>

                            <li>
                                <a href="">Tagging Point(Depot)</a>
                            </li> --}}
                        </ul>
                    </li>


                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <!-- <div class="loading loading--full-height"></div> -->
                {{-- @include('flash-message') --}}

                @yield('content')
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">
                    <script>
                        document.write(new Date().getFullYear());
                    </script> &copy;<b>EMS</b> - All rights reserved.
                </div>

                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->

    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <!-- <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div> -->
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    @livewireScripts
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


    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script> --}}

    <!-- <script src="http://code.jquery.com/jquery.js"></script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.display').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true
                    }

                ],
                order: [
                    [0, "desc"]
                ],
                responsive: true

            });
        });
    </script>

    {{-- <script src="{{ asset('AjaxJs/deviceStatus.js') }}" type="text/javascript"></script> --}}

</body>

</html>
