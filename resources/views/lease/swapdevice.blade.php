@extends('layouts.main') @section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <div class="container">

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

        <form method="POST" action="{{ route('swap-store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row justify-content-center">
                <div class="col-md-8 card">
                    <div class="card-body">
                        <div class="card-header bg-primary">
                            Swap Device
                        </div>
                        <div class="form-group">
                            <div class="mt-3">
                                <input type="text" readonly="" value="{{ $leases->lease_number }}"
                                    class="form-control" name="lease_number">
                            </div>
                        </div>


                        <div class="form-group mt-3">

                            <div class="mt-3">
                                <label for="">Current Master</label>
                                <input type="text" readonly="" value="{{ $leases->master->Devicenumber }}"
                                    class="form-control" name="master_old">
                            </div>

                            <div class="mt-3">
                                <label for="">Current Slaves</label>
                                <ul>
                                    @foreach ($leases->devices as $key => $slaveDevice)
                                        <li>{{ $slaveDevice->Devicenumber }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div id="" class="form-group mt-3">
                            <div class="">
                                <label for="">Swap Master</label>
                                <select name="master" id="masterSelect"
                                    class="js-example-disabled-results form-control mt-2">
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
                        </div>


                        <div class="mt-4" id="hiddenInputWrapper">
                            <label style="font-weight: 900">Slaves:</label>
                            <ul id="dispatchSlavesList">
                            </ul>
                        </div>





                    </div>
                    <div class="row">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>


    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>


    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>
    <script>
        var $disabledResults = $(".js-example-disabled-results");
        $disabledResults.select2();


        $(".js-example-basic-multiple-limit").select2({
            maximumSelectionLength: 100
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
