@extends('layouts.main')
@section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container--open {
            z-index: 9999 !important;

        }

        .select2-container {
            width: 100%;
            /* You can adjust this value to your preferred width */
        }
    </style>



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



        {{-- <a href="{{ route('status') }}">status</a> --}}

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
                                    <th>MASTER_ID</th>
                                    <th>SLAVE_IDS</th>
                                    <th>DATE_RECEIVED</th>
                                    <th>Action</th>
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
                                        <td>
                                            <a href="{{ url('/device/status', $device->device[0]['Devicenumber']) }}"
                                                class="btn btn-primary">{{ $device->device[0]['Devicenumber'] }}
                                            </a>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($device->dispatch_slave as $slave)
                                                    <li class="mt-3">{{ $slave->device[0]->Devicenumber }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $device->updated_at }}</td>
                                        <td>
                                            <a href="#" class="btn btn-warning edit-device"
                                                data-device-id="{{ $device->id }}" data-toggle="modal"
                                                data-target="#editModal">
                                                Edit
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
            </div>
            </form>

            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Add Device</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('store-edit') }}" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" id="deviceIDInput" name="master_id" value="">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Select Slaves</label>
                                            <br>
                                            <select class="js-example-basic-multiple" name="slaves[]" multiple="multiple">
                                                @foreach ($deviceX as $slaveDevice)
                                                    @if ($slaveDevice->status == 0)
                                                        @foreach ($slaveDevice->dispatch_slave as $slave)
                                                            <option value="{{ $slave->device[0]->id }}">
                                                                {{ $slave->device[0]->Devicenumber }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Slave</button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        @endif





        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
            integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
            crossorigin="anonymous"></script>
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
        <script>
            $(document).ready(function() {
                // Initialize modal
                $('#editModal').on('shown.bs.modal', function() {
                    // Initialize Select2 inside the modal
                    $('.js-example-basic-multiple').select2();
                });

                // Other JavaScript code...
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.edit-device').click(function() {
                    var deviceID = $(this).data('device-id');
                    $('#deviceIDInput').val(deviceID); // Set the device ID in the hidden input field
                });
            });
        </script>


    @endsection
