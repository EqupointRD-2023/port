@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">


    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center"> LEASED CASH SUMMARY</th>


                            </tr>
                            <tr>

                                <th>TOTAL LEASED</th>
                            </tr>

                        </thead>
                        <tbody id="tb1">

                            <tr>
                                <td>TOTAL</td>
                                <td colspan="2" class="text-center">{{ $cash }}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <div class="box-body">

                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center"> LEASE CREDIT SUMMARY</th>
                            </tr>
                            <tr>
                                <th>TOTAL LEASED</th>
                            </tr>

                        </thead>
                        <tbody id="tb1">

                            <tr>
                                <td>TOTAL</td>
                                <td colspan="2" class="text-center">{{ $bill }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
    <br />
    <br />




    <div class="row">
        <form action="" method="POST">
            {{ csrf_field() }}

            <table width="100%">
                <tr>
                    <td>
                        <input type="text" name="query" class="form-control col-md-12"
                            placeholder="ENTER TRUCK #, OR DEVICE NUMBER">

                    </td>
                    <td style="text-align:right">
                        <button type="submit" class="btn btn-success"> SEARCH</button>

                    </td>
                </tr>

            </table>

        </form>
    </div>

    <br><br>

    <?php $date = Carbon\Carbon::today()->subDays(1); ?>



    <div class="row">


        @if ($cash + $bill > 0)
            @foreach ($leases as $key => $dt)
                <div class="box box-success ">
                    <div class="box-header with-border">
                        @if ($dt->lease_type == 1)
                            <table width="100%">
                                <tr>
                                    <td>
                                        <h5 class="btn btn-success btn-sm ">CASH LEASED</h5>
                                    </td>
                                    <td style="text-align:right"><a
                                            href="{{ url('/lease/' . $dt->lease_number . '/receipt') }}"
                                            class="btn btn-primary btn-sm float-right">PRINT</a></td>
                                </tr>

                            </table>
                        @elseif($dt->lease_type == 2)
                            <table width="100%">
                                <tr>
                                    <td>
                                        <h5 class="btn btn-warning btn-sm ">CREDIT LEASED</h5>
                                    </td>
                                    <td style="text-align:right"><a sty
                                            href="{{ url('/lease/' . $dt->lease_number . '/receipt') }}"
                                            class="btn btn-primary btn-sm float-right">PRINT</a></td>
                                </tr>

                            </table>
                        @endif
                    </div>

                    <div class=" box-body">


                        <table width="100%">

                            <tr>
                                <td>Receipt No.</td>
                                <td style="text-align:right">{{ $dt->lease_number }}</td>
                            </tr>
                            @if ($dt->slave == null)
                                <tr>
                                    <td>Master #:</td>
                                    <td style="text-align:right">
                                        <h5><strong>{{ $dt->master->Devicenumber }}</strong></h5>
                                    </td>

                                </tr>
                            @else
                                <tr>
                                    <td>Master #:</td>
                                    <td style="text-align:right">
                                        <h5><strong>{{ $dt->master->Devicenumber }}</strong></h5>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Slave #:</td>
                                    <td style="font-size: 15px; text-align: right;">
                                        @foreach ($dt->devices as $slave)
                                            <h6><strong>{{ $slave->Devicenumber }}</strong></h6>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif


                            <tr>
                                <td>Client Name:</td>
                                @if ($dt->lease_type == 2)
                                    <td style="text-align:right">{{ $dt->customer->compy_name }}</td>
                                @elseif($dt->lease_type == 1)
                                    <td style="text-align:right">{{ $dt->customer_name }}</td>
                                @endif
                            </tr>
                            @if ($dt->cargo_type == 3)
                                <tr>
                                    <td>ChasisNo #:</td>
                                    <td style="text-align:right">{{ $dt->chasis_number }}</td>
                                </tr>

                                <tr>
                                    <td>IT #:</td>
                                    <td style="text-align:right">{{ $dt->It_number }}</td>

                                </tr>
                            @elseif($dt->cargo_type == 1)
                                <tr>
                                    <td>Truck #:</td>
                                    <td style="text-align:right">{{ $dt->truck_number }}</td>
                                </tr>
                                <tr>
                                    <td>Trailer #:</td>
                                    <td style="text-align:right">{{ $dt->trailer_number }}</td>

                                </tr>
                            @elseif($dt->cargo_type == 2)
                                <tr>
                                    <td>Container #:</td>
                                    <td style="text-align:right">09</td>
                                </tr>
                                <tr>
                                    <td>Truck #:</td>
                                    <td style="text-align:right">{{ $dt->truck_number }}</td>
                                </tr>
                                <tr>
                                    <td>Trailer #:</td>
                                    <td style="text-align:right">{{ $dt->trailer_number }}</td>

                                </tr>
                            @elseif($dt->cargo_type == 4)
                                <tr>
                                    <td>Truck #:</td>
                                    <td style="text-align:right">{{ $dt->truck_number }}</td>
                                </tr>
                                <tr>
                                    <td>Trailer #:</td>
                                    <td style="text-align:right">{{ $dt->trailer_number }}</td>

                                </tr>
                                </tr>
                            @endif

                            <tr>
                                <td>Driver Name:</td>
                                <td style="text-align:right">{{ $dt->driver_name }}</td>

                            </tr>
                            <tr>
                                <td>Driver Phone:</td>
                                <td style="text-align:right">{{ $dt->driver_phone }}</td>

                            </tr>
                            <tr>
                                <td>Border Name:</td>
                                <td style="text-align:right">{{ $dt->border->name }}</td>

                            </tr>
                            <tr>
                                <td>CargoType:</td>
                                <td style="text-align:right">
                                    @if ($dt->cargo_type == 1)
                                        LOOSE CARGO
                                    @elseif($dt->cargo_type == 2)
                                        CONTAINERIZED
                                    @elseif($dt->cargo_type == 3)
                                        IT
                                    @elseif($dt->cargo_type == 4)
                                        TANKER
                                    @else
                                        OTHER CARGO
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Tag By:</td>
                                <td style="text-align:right">{{ $dt->tager->name }}</td>

                            </tr>
                            <tr>
                                <td>Tag Area:</td>
                                <td style="text-align:right">{{ $dt->tag->tag_name }}</td>
                            </tr>
                            <tr>
                                <td>Tag Date:</td>
                                <td style="text-align:right">{{ $dt->created_at }}</td>

                            </tr>

                        </table>
                    </div>

                    <?php $days_count = Carbon\Carbon::parse($dt->created_at)->diffInDays($date);
                    
                    ?>



                    <div class="box-footer">
                        @if ($days_count < 7)
                            <a href="{{ url('/lease/' . $dt->lease_number) . '/swap' }}"
                                class="btn btn-sm btn-warning">SWAP</a>
                            {{-- @if ($dt->lease_type == 1)
                                <a href="{{ url('/lease/' . $dt->lease_number) . '/swap' }}"
                                    class="btn btn-sm btn-warning">SWAP</a>

                                <a href="{{ url('' . $dt->lease_number) }}" class="btn btn-sm btn-info">EDIT-CASH</a>
                            @elseif($dt->lease_type == 2)
                                <a href="{{ url('' . $dt->lease_number) }}" class="btn btn-sm btn-info">EDIT-BILL</a>
                                <a href="{{ url('' . $dt->lease_number) }}" class="btn btn-sm btn-warning">SWAP</a>
                            @endif --}}



                            {{-- @if ($dt->cancel_bill == 0)
                                <a href="{{ url('' . $dt->bill_number) }}" class="btn btn-sm btn-danger">CANCEL</a>
                            @else
                                <a href="#" class="btn btn-sm btn-default">CANCELLED</a>
                            @endif --}}
                        @endif




                    </div>

                </div>
            @endforeach
        @else
            <div class="alert alert-danger alert-block">
                <!-- <button type="button" class="close" data-dismiss="alert">Ã—</button> -->
                <span class="text-center"> No Lease Found</span>
            </div>
        @endif

    </div>

    <style type="text/css">
        table {
            font-size: 16px;
            /*width: 100%;*/


        }
    </style>
@endsection
