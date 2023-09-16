@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">


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
            @endif @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                    @endif @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
    </div>
    <br />
    <br />

    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                </div>
                <div class="box-body">

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
            </div>
        </div>



        <br />
        <br />

        {{-- <div class="form-group col-md-12">
            <label for="sel1">Search:</label>
            <input type="text" class="form-control" name="DEVICE_ID " placeholder="SEARCH DEVICE_ID" id="deviceNumb">

        </div> --}}
        <br>
        <br>


        @if ($date != null)
            <div class="form-group col-md-12">
                <form action="{{ route('stock-return', $date->dispatchNo) }}" method="post">
                    @csrf
                    <button style="margin: 5px;" class="btn btn-success  delete-all">RETURN</button><br><br>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="font-size: 0.78em;">
                                    <th><input type="checkbox" id="checkAllButton"></th>
                                    <th>#</th>
                                    <th>UNIT_ID</th>
                                    <th>DATE_RECEIVED</th>
                                    <!-- Add a new column for checkboxes -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deviceX as $key => $device)
                                    <tr>
                                        <td>
                                            <input id="checkAllButton" type="checkbox" name="device_check[]"
                                                value="{{ $device->device[0]['Devicenumber'] }}">
                                        </td>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $device->device[0]['Devicenumber'] }}</td>
                                        <td>{{ $device->updated_at }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
            </div>
            </form>
        @endif





        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // JavaScript code to check all checkboxes when the "Check All" button is clicked
                document.getElementById('checkAllButton').addEventListener('click', function() {
                    var checkboxes = document.getElementsByName('device_check[]');
                    var checkAllCheckbox = this;

                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = checkAllCheckbox.checked;
                    });
                });
            });
        </script>



    @endsection
