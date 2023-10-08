@extends('layouts.main') @section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        .select2-container {
            width: 100% !important;
            z-index: 9999999;
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



    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header h4 text-center bg-primary">
                    Lease Device
                </div>
                <div class="card-body">
                    <form action="{{ route('lease-store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="selectNumber">Lease Type:</label>
                            <select name="lease_type" class="form-control mt-2" id="selectsaletype"
                                onchange="saletypechange()">
                                <option selected>select</option>
                                <option value="1"> Cash</option>
                                <option value="2"> Credit</option>
                            </select>
                        </div>


                        <div class="mt-4 showCustomer"style="display: none;" class="mt-2">
                            <label for="hiddenInput">Cash Customer Name:</label>
                            <input type="text" id="customerName" name="customerName" class="form-control mt-2"
                                placeholder="Cash Customer Name">
                        </div>

                        <div class="mt-4">
                            <label for="selectNumber">Currency:</label>
                            <div id="A5" class="form-group mt-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-book"
                                            aria-hidden="true"></span></span>
                                    <select name="currency" class="form-control currency">
                                        <option value="">Currency</option>
                                        <option value="1">USD</option>
                                        <option value="2">TZS</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4" style="display: none;" id="showCustomer">
                            <label for="selectNumber">Select Customer:</label>
                            <select name="customerId" id="#customerNameT" class="form-control mt-2">
                                <option value="" selected>select</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->compy_name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mt-4">
                            <label for="selectNumber">Cargo Type:</label>
                            <select name="cargo_type" id="selectNumber" class="form-control mt-2">
                                <option value="1">LOOSE CARGO</option>
                                <option value="2">CONTAINERIZED</option>
                                <option value="3">IT</option>
                                <option value="4">TANKER</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label>Select Master:</label>
                            <select name="master" id="masterSelect" class="js-example-disabled-results form-control mt-2">
                                <option selected>select</option>
                                @foreach ($devices as $device)
                                    @if ($device->device[0]->devicetype == 1)
                                        <option value="{{ $device->device[0]->id }}"
                                            data-dispatch-slaves="{{ json_encode($device->dispatch_slave) }}">
                                            {{ $device->device[0]->Devicenumber }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>

                        <div class="mt-4" id="hiddenInputWrapper" style="display: none;"">
                            <label style="font-weight: 900">Slaves:</label>
                            <ul id="dispatchSlavesList">
                            </ul>
                        </div>




                        {{-- <div class="mt-4" id="hiddenInputWrapper" style="display: none;" class="mt-2">
                            <label for="hiddenInput">Select Slave:</label>
                            <select name='slave[]' id="selectMultiple" class="js-example-basic-multiple-limit form-control"
                                multiple>
                                @foreach ($devices as $device)
                                    @if ($device->device[0]->devicetype == 2)
                                        <option value="{{ $device->device[0]->id }}">
                                            {{ $device->device[0]->Devicenumber }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div> --}}



                        <div class="mt-4">
                            <label for="hiddenInput">Select Border:</label>
                            <div class="input-group mt-2">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-list"
                                        aria-hidden="true"></span></span>
                                <select name="borderId" class=" form-control border_id">
                                    <option value="">Select Border</option>
                                    @foreach ($borders as $key => $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="mt-4">
                            <label for="hiddenInput">Select Tag Point:</label>
                            <div class="form-group mt-2">
                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list"
                                            aria-hidden="true"></span></span>
                                    <select name="tagPointId" class="form-control tagPoint_id">
                                        <option value="">Select Tag Point</option>
                                        @foreach ($tagpoints as $key => $dt)
                                            <option value="{{ $dt->id }}">{{ $dt->tag_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="mt-4">
                            <label for="hiddenInput">Driver Name:</label>
                            <div class="form-group mt-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"
                                            aria-hidden="true"></span></span>
                                    <input type="text" class="form-control driverLicense" placeholder="Driver Name"
                                        name="driverName">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="hiddenInput">Driver Phone Number:</label>
                            <div class="form-group mt-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list"
                                            aria-hidden="true"></span></span>
                                    <input type="text" class="form-control driverPhone"
                                        placeholder="Driver Phone Number" name="driverPhone">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="hiddenInput">Driver License:</label>
                            <div class="form-group mt-2">
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-list"
                                            aria-hidden="true"></span></span>
                                    <input type="text" class="form-control driverPhone" placeholder="Driver License"
                                        name="driverLicense">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 ITNumber"style="display: none;" class="mt-2">
                            <label for="hiddenInput">Chasis Number:</label>
                            <input type="numbers" name="chasis_number" class="form-control mt-2"
                                placeholder="Chasis Number">
                        </div>

                        <div class="mt-4 ITNumber"style="display: none;" class="mt-2">
                            <label for="hiddenInput">IT Number:</label>
                            <input type="numbers" name="ITNumber" class="form-control mt-2" placeholder="IT Number">
                        </div>



                        <div class="mt-4 ITNumber"style="display: none;" class="mt-2">
                            <label for="hiddenInput">Brand/Model Name:</label>
                            <input name="brand" type="text" class="form-control mt-2"
                                placeholder="Brand/Model Name">
                        </div>

                        <div class="mt-4 TruckNumber" class="mt-2">
                            <label for="hiddenInput">Truck Reg Number:</label>
                            <input type="numbers" name="TruckNumber" class="form-control mt-2"
                                placeholder="Truck Reg Number">
                        </div>
                        <div class="mt-4 TrailerNumber" class="mt-2">
                            <label for="hiddenInput">Trailer Number:</label>
                            <input type="numbers" name="TrailerNumber" class="form-control mt-2" placeholder="Trailer">
                        </div>

                        <div class="row mt-3" id="submitButton">
                            <button type="submit" class="btn btn-primary ">LEASING</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Function to handle the selection change event
            $('#selectNumber').on('change', function() {
                var selectedValue = $(this).val();
                // If the selected value is 2, show the hidden input; otherwise, hide it
                if (selectedValue === '4') {
                    $('#hiddenInputWrapper').show();
                } else {
                    $('#hiddenInputWrapper').hide();
                }
            });

            $('#selectNumber').on('change', function() {
                var selectedValue = $(this).val();
                // If the selected value is 3, show the hidden input; otherwise, hide it
                if (selectedValue == '3') {
                    $('.ITNumber').show();
                } else {
                    $('.ITNumber').hide();

                }
            });


            $('#selectNumber').on('change', function() {
                var selectedValue = $(this).val();
                // If the selected value is 3, show the hidden input; otherwise, hide it
                if (selectedValue != '3') {
                    $('.TruckNumber').show();
                    $('.TrailerNumber').show();
                } else {
                    $('.TruckNumber').hide();
                    $('.TrailerNumber').hide();

                }
            });




            $('#selectsaletype').on('change', function() {
                var selectedValue = $(this).val();

                if (selectedValue === '2') {
                    $('#showCustomer').show();
                } else {
                    $('#showCustomer').hide();
                    $('#customerNameT').val('');
                }
            });




            $('#selectsaletype').on('change', function() {
                var selectedValue = $(this).val();
                // If the selected value is 2, show the hidden input; otherwise, hide it
                if (selectedValue === '1') {
                    $('.showCustomer').show();
                } else {
                    $('.showCustomer').hide();
                    $('#customerName').val('');
                }
            });
        });
    </script>


    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();


        $(".js-example-basic-multiple-limit").select2({
            maximumSelectionLength: 100
        });
    </script>



    <script>
        // Wait for the page to load
        document.addEventListener('DOMContentLoaded', function() {
            // Get the reference to the submit button
            const submitButton = document.getElementById('submitButton');

            // Add a click event listener to the form submission
            document.querySelector('form').addEventListener('submit', function() {
                // Disable the submit button to prevent multiple submissions
                submitButton.disabled = true;
            });
        });
    </script>


    <script>
        console.log('Script is running');
        $('#masterSelect').on('change', function() {
            console.log('Dropdown change event triggered');
            var selectedOption = $(this).find('option:selected');
            var dispatchSlavesData = selectedOption.data('dispatch-slaves');

            console.log('Selected Option Data:', dispatchSlavesData);

            $('#dispatchSlavesList').empty();

            // Iterate through the dispatchSlavesData and extract Devicenumber
            for (var i = 0; i < dispatchSlavesData.length; i++) {
                var dispatchSlave = dispatchSlavesData[i];
                var deviceNumber = dispatchSlave.device[0].Devicenumber; // Extract Devicenumber
                console.log('Device Number:', deviceNumber);

                // Add the deviceNumber to your list
                $('#dispatchSlavesList').append('<li>' + deviceNumber + '</li>');
            }
        });
    </script>


@endsection
