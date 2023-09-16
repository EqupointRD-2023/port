@extends('layouts.app')
@section('content')
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
    </div>

    <br><br>



    <div class="row">

        <div class="col-md-12">

            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Customers</div>
                                <a href="" type="button" class="btn btn-success  pull-right" data-toggle="modal"
                                    data-target="#customer">
                                    Create Customer</a>
                            </div>

                            <!-- /.box-header -->
                            <div class="ibox-body">
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company Name</th>
                                            <th>Phone Number</th>
                                            <th>Customer Type</th>
                                            <th>Address Name</th>
                                            <th>Currency</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $key => $dt)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dt->compy_name }}</td>
                                                <td>
                                                    {{ $dt->phone }}
                                                </td>
                                                <td>
                                                    {{ $dt->customer_type }}
                                                </td>
                                                <td>
                                                    {{ $dt->address_name }}
                                                </td>
                                                <td>
                                                    {{ $dt->currency }}
                                                </td>

                                                <td>
                                                    <a href="" type="button" data-toggle="modal"
                                                        data-target="#show"> <i class="fa fa-edit"></i>
                                                        Edit</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <!-- /.col -->

                    </div>
                    <!-- /.row -->


                </div>
            </div>
        </div>


        <!-- Button trigger modal -->






        <div id="show" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Device List</h4>
                    </div>
                    <form action="{{ route('dispatch-store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <div>
                                        <label for="">Price</label>
                                        <input type="text" class="form-control" name="devicenumber"
                                            placeholder="Edit Price" required>

                                    </div>



                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




    </div>

@endsection
