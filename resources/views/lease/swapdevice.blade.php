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

                        </div>

                        <div id="" class="form-group mt-3">
                            <div class="">
                                <label for="">Swap Master</label>
                                <select name="master" id="selectMultiple"
                                    class="js-example-basic-multiple-limit form-control" data-live-search="true">
                                    <option value="">[SELECT MASTER]</option>
                                    @foreach ($devices as $key => $dt)
                                        @if ($dt->device[0]->devicetype == 1)
                                            <option value="{{ $dt->device[0]->id }}">{{ $dt->device[0]->Devicenumber }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        @foreach ($all as $key => $slave)
                            <div class="form-group mt-3">
                                <div class="mt-3">
                                    <label for="">Current Slave - {{ $key + 1 }} </label>
                                    <select name="slave_old[]" class="form-control" disabled>
                                        <option value="{{ $slave->slave->id }}">{{ $slave->slave->Devicenumber }}
                                        </option>
                                    </select>

                                    <select name="slave_old[]" class="form-control" hidden>
                                        <option value="" selected>select</option>
                                        <option value="{{ $slave->slave->id }}">{{ $slave->slave->Devicenumber }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div id="" class="form-group mt-3">
                                <div class="">
                                    <label for="">Swap Slave - {{ $key + 1 }}</label>
                                    <select name="slave[]" id="selectMultiple{{ $key + 1 }}"
                                        class="js-example-basic-multiple-limit form-control" data-live-search="true">
                                        data-live-search="true">
                                        <option value="" selected>[SELECT Slave]</option>
                                        @foreach ($devices as $key => $dt)
                                            @if ($dt->device[0]->devicetype == 2)
                                                <option value="{{ $dt->device[0]->id }}">
                                                    {{ $dt->device[0]->Devicenumber }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endforeach
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
@endsection
