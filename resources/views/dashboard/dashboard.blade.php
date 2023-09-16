@extends('layouts.app')
@section('content')
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-success color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">201</h2>
                        <div class="m-b-5">TOTAL DEVICE</div><i class="ti-shopping-cart widget-stat-icon"></i>
                        <!-- <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-info color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">1250</h2>
                        <div class="m-b-5">TOTAL DELIVERED ORDER</div><i class="ti-bar-chart widget-stat-icon"></i>
                        <!-- <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-warning color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">$1570</h2>
                        <div class="m-b-5">TOTAL COST</div><i class="fa fa-money widget-stat-icon"></i>
                        <!-- <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div> -->
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="ibox bg-danger color-white widget-stat">
                    <div class="ibox-body">
                        <h2 class="m-b-5 font-strong">108</h2>
                        <div class="m-b-5">PENDING ORDER</div><i class="ti-user widget-stat-icon"></i>
                        <!-- <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div> -->
                    </div>
                </div>
            </div>
        </div>





        <style>
            .visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }
        </style>

    </div>
    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2022 © - All rights reserved.</div>
        <a class="px-4" href="#" target="_blank">EQUPOINT</a>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
    </div>
@endsection
