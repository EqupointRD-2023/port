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

            <div class="row justify-content-center align-content-center">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            Filter Report
                        </div>
                        <div class="card-body">
                            <form action="{{ route('report-all-return') }}" method="POST">
                                {{ csrf_field() }}
                                <div class=" box-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Report Date</label>
                                        <input type="date" name="date" required class="form-control"
                                            id="exampleFormControlInput1">
                                    </div>



                                </div>
                                <div class="box-footer">
                                    <button type="submit" id="filter" class="btn btn-info w-100">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
