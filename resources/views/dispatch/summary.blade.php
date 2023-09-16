@extends('layouts.app')
@section('content')
    <style media="screen">
        .ScrollStyle {
            max-height: 500px;
            overflow-y: scroll;
        }
    </style>
    <div class="page-heading">
        <h1 class="page-title">Dispatch</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html"><i class="la la-home font-20"></i></a>
            </li>
            <!-- <li class="breadcrumb-item">Customer Form</li> -->
        </ol>
    </div>

    <br><br>




    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ $message }}</strong>

                    </div>
                @endif

                @if ($message = Session::get('danger'))
                    <div class="alert alert-danger alert-block">

                        <button type="button" class="close" data-dismiss="alert">×</button>

                        <strong>{{ $message }}</strong>

                    </div>
                @endif
            </div>
        </div>



        <div class="ibox">
            <div class="ibox-head">
                <h3 class="ibox-title">Dispatch Details</h3>

                <br>

            </div>
            <!-- /.box-header -->
            <div class="ibox-body">
                <div class="row">
                    <div class="col-md-4">
                        {{-- <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th>ITEMS</th>

                                    <th>TOTAL</th>
                                </tr>

                            </thead>

                            <tbody>
                                <tr>
                                    <td>MASTER</td>
                                    <td>{{ $master }}</td>
                                </tr>

                                <tr>
                                    <td>SLAVE</td>

                                    <td>{{ $slave }}</td>
                                </tr>

                                <tr>
                                    <td>TOTAL DEVICE</td>
                                    <td>
                                        {{ $master + $slave }}
                                    </td>

                                </tr>

                            </tbody>
                        </table> --}}
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                    <th colspan="3" class="text-center">MY STOCK SUMMARY</th>


                                </tr>
                                <tr>
                                    <th>ITEMS</th>
                                    <th>MODEL</th>
                                    <th>TOTAL REMAIN</th>
                                </tr>

                            </thead>
                            <tbody id="tb1">
                                <tr>
                                    <td rowspan="2">MASTER</td>
                                    <td>HB</td>
                                    <td>{{ $masterHb }}</td>
                                </tr>
                                <tr>
                                    <td>JT</td>
                                    <td>{{ $masterJt }}</td>

                                </tr>
                                <tr>
                                    <td rowspan="2">SLAVE</td>
                                    <td>HB</td>
                                    <td>{{ $slaveHb }}</td>
                                </tr>
                                <tr>
                                    <td>JT</td>
                                    <td>{{ $slaveJt }}</td>

                                </tr>
                                <tr>
                                    <td>TOTAL</td>
                                    <td colspan="2" class="text-center">
                                        {{ $masterHb + $masterJt + $slaveHb + $slaveJt }}
                                    </td>

                                </tr>
                            </tbody>
                        </table>


                    </div>


                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 ScrollStyle">



                                <table class="table table-hover table-striped ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>DEVICE NUMBER</th>
                                            <th>DEVICE TYPE</th>
                                            {{-- <th>DEVICE MODEL</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $dt)
                                            <tr>
                                                {{-- <input type="hidden" name="unit_id[]" value="{{ $dt->Did }}"> --}}

                                                <td>{{ ++$key }}</td>
                                                <td>{{ $dt->Devicenumber }}</td>
                                                <td>
                                                    @if ($dt->devicetype == 1)
                                                        Master
                                                    @else
                                                        Slave
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $dt->deviceTypeName }}</td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>

                            </div>
                        </div>







                        <form method="POST" action="{{ route('dispatch-send') }}">
                            {{ csrf_field() }}

                            <!-- Your view file -->
                            <input type="hidden" name="requestId" value="{{ $requestId }}">
                            @foreach ($devices as $item)
                                <input type="hidden" name="devices[]" value="{{ $item->Devicenumber }}">
                                <!-- Add other looped data as needed -->
                            @endforeach



                            <div class="box-footer">
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                                <button type="submit" class="btn btn-info w-25 pull-right">Send</button>
                            </div>
                        </form>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-4">


                        <table class="table table-bordered ">

                            <tbody>


                                <tr>
                                    <td style="font-weight: bold">Requisition Number</td>

                                    <td> {{ $requestId }}</td>
                                </tr>



                                <tr>
                                    <td style="font-weight: bold">Requester</td>
                                    <td>
                                        {{ $user->name }}
                                    </td>

                                </tr>

                                <tr>
                                    <td style="font-weight: bold">Requested</td>
                                    <td>
                                        {{ $quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold">Founded</td>
                                    <td>
                                        {{ $masterHb + $masterJt + $slaveHb + $slaveJt }}
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        </div>

    @endsection
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
