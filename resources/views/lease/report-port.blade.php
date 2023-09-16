@extends('layouts.main') @section('content')
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style media="screen">
        .select2-container {
            width: 100% !important;
            z-index: 9999999;
        }
    </style>


    <div class="row">

        <div class="box box-info">
            <div class="box-header with-border">
            </div>
            <form action="{{ route('lease-get-report') }}" method="POST">
                {{ csrf_field() }}
                <div class=" box-body">


                    <div class=" mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Lease Type</label>

                        <select class="form-select" name="leasetype" required>
                            <option value="1">CASH</option>
                            <option value="2">BILL</option>
                        </select>
                    </div>

                    <div id="A1" class="form-group  ">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-list"
                                    aria-hidden="true"></span></span>
                            <select name="customer_id" class="js-example-basic-single form-control credit_customer_id"
                                data-live-search="true">
                                <option value="" selected>select customer</option>
                                @foreach ($customers as $key => $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->compy_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">From</label>
                        <input type="date" name="from" required class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">To</label>
                        <input type="date" name="to" required class="form-control" id="exampleFormControlInput1">
                    </div>


                </div>
                <div class="box-footer">
                    <button type="submit" id="filter" class="btn btn-info ">Filter</button>
                </div>
        </div>
    </div>
    </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
