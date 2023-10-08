@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>
                            <span style="font-weight: bold"> Date:</span>
                            <span>{{ $date }}</span>
                        </p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p>
                            <span style="font-weight: bold"> Name:</span>
                            <span>{{ auth()->user()->name }}</span>
                        </p>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p>
                            <span style="font-weight: bold"> Team:</span>
                            <span>{{ auth()->user()->team->team_name }}</span>
                        </p>
                    </div>
                </div>

                <div class="mt-3">
                    <h6 style="font-weight: bold">OPENING/RECEIVED STOCKS</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-success">OPENING BALANCE</th>
                                <th class="bg-success">RECEIVED BALANCE</th>
                                <th class="bg-success">TOTAL UNIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $openingMaster }}</td>
                                                <td>{{ $openingSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $receivedMaster }}</td>
                                                <td>{{ $receivedSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master</th>
                                                <th>Slave</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $openingMaster + $receivedMaster }}</td>
                                                <td>{{ $openingSlave + $receivedSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <h6 style="font-weight: bold">Sales</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-warning">TAGED UNIT BY CASH</th>
                                <th class="bg-warning">TAGED UNIT BY CREDIT</th>
                                <th class="bg-warning">TOTAL UNIT SOLD</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $leaseCashMaster }}</td>
                                                <td>{{ $leaseCashSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $leaseBillMaster }}</td>
                                                <td>{{ $leaseBillSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master</th>
                                                <th>Slave</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $leaseCashMaster + $leaseBillMaster }}</td>
                                                <td>{{ $leaseCashSlave + $leaseBillSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <h6 style="font-weight: bold">CLOSING STOCK BALANCE</h6>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" style="margin-bottom: 100px">
                        <thead>
                            <tr>
                                <th class="bg-info">RETURNED TO HQ</th>
                                <th class="bg-info">CLOSING BALANCE/REMAINED</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $returnedDeviceMaster }}</td>
                                                <td>{{ $returnedDeviceSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Master Unit</th>
                                                <th>Slave Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $closingMaster }}</td>
                                                <td>{{ $closingSlave }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('coment') }}" method="post">
                        @csrf
                        @if ($coment <= 0)
                            <div>
                                <div class="row">
                                    <div class="col-md 6">
                                        <h2 class="text-center h6">Currency:</h2>
                                        <select name="currency" id="" class="form-control">
                                            <option value="TZS" selected>TZS</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </div>
                                    <div class="col-md 6">
                                        <h2 class="text-center h6">Amount:</h2>
                                        <input name="amount" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center h6 mt-5">Comment:</h2>
                            <textarea name="comment" id="" cols="10" rows="10" class="form-control"></textarea>
                            <button class="btn btn-primary  mt-2">Send</button>
                        @else
                            <div>
                                <div class="row">
                                    <div class="col-md 6">
                                        <h2 class="text-center h6">Currency:</h2>
                                        <select name="currency" id="" class="form-control" disabled>
                                            <option value="TZS" selected>{{ $mycomment->currency }}</option>
                                            {{-- <option value="USD">USD</option> --}}
                                        </select>
                                    </div>
                                    <div class="col-md 6">
                                        <h2 class="text-center h6">Amount:</h2>
                                        <input name="amount" placeholder="{{ $mycomment->amount }}" type="number"
                                            class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <h2 class="text-center h6 mt-4">Comment:</h2>
                            <textarea disabled name="" id="" cols="10" rows="10" value='{{ $mycomment }}'
                                placeholder="{{ $mycomment->comment }}" class="form-control"></textarea>
                            {{-- <button class="btn btn-primary mt-2">Send</button> --}}
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
