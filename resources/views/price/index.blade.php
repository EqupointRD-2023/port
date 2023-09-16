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
                                <div class="ibox-title">Price</div>
                                <a href="" type="button" class="btn btn-success  pull-right" data-toggle="modal"
                                    data-target="#create">
                                    Create Price</a>
                            </div>

                            <!-- /.box-header -->
                            <div class="ibox-body">
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Cargo Type</th>
                                            <th>Master Price USD</th>
                                            <th>Master Price TZS</th>
                                            <th>Slave Price USD</th>
                                            <th>Slave Price TZS</th>
                                            <th>Add Slave Price USD</th>
                                            <th>Add Slave Price TZS</th>



                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($prices as $key => $dt)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dt->cargo_type }}</td>
                                                <td>
                                                    {{ $dt->master_price_usd }}
                                                </td>
                                                <td>
                                                    {{ $dt->master_price_tzs }}
                                                </td>
                                                <td>
                                                    {{ $dt->slave_price_usd }}
                                                </td>
                                                <td>
                                                    {{ $dt->slave_price_tzs }}
                                                </td>
                                                <td>
                                                    {{ $dt->add_slave_price_usd }}
                                                </td>
                                                <td>
                                                    {{ $dt->add_slave_price_tzs }}
                                                </td>


                                                <td>
                                                    <a href="" type="button" data-toggle="modal"
                                                        data-target="#edit{{ $dt->id }}"> <i class="fa fa-edit"></i>
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






        <div id="edit{{ $dt->id }}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Device List</h4>
                    </div>
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <label for="">Master Price USD</label>
                                        <input type="number" class="form-control" value="{{ $dt->master_price_usd }}"
                                            name="master_price_usd" placeholder="Edit Price" required>
                                    </div>

                                    <div>
                                        <label for="">Master Price TZS</label>
                                        <input type="number" class="form-control" value="{{ $dt->master_price_tzs }}"
                                            name="master_price_tzs" required>
                                    </div>

                                    <div>
                                        <label for="">Slave Price USD</label>
                                        <input type="number" class="form-control" value="{{ $dt->slave_price_usd }}"
                                            name="slave_price_usd" placeholder="Edit Price" required>
                                    </div>

                                    <div>
                                        <label for="">Slave Price TZS</label>
                                        <input type="number" class="form-control" value="{{ $dt->slave_price_tzs }}"
                                            name="slave_price_tzs" placeholder="Edit Price" required>
                                    </div>
                                    <div>
                                        <label for="">Additional Slave Price TZS</label>
                                        <input type="number" class="form-control" value="{{ $dt->add_slave_price_usd }}"
                                            name="add_slave_price_usd" placeholder="Edit Price" required>
                                    </div>
                                    <div>
                                        <label for="">Additional Slave Price TZS</label>
                                        <input type="number" class="form-control" value="{{ $dt->add_slave_price_usd }}"
                                            name="add_slave_price_usd" placeholder="Edit Price" required>
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
