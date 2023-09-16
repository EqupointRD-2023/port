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
                                <div class="ibox-title">Device </div>
                                <a href="" type="button" class="btn btn-success  pull-right" data-toggle="modal"
                                    data-target="#customer">
                                    Create DEVICES</a>
                            </div>

                            <!-- /.box-header -->
                            <div class="ibox-body">
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Device Number</th>
                                            <th>Device Type</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($devices as $key => $dt)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dt->Devicenumber }}</td>
                                                <td>
                                                    @if ($dt->Devicetype == 1)
                                                        Master
                                                    @else
                                                        Slave
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dt->status == 1)
                                                        <button class="btn btn-success">Store</button>
                                                    @else
                                                        <button class="btn btn-primary">Port Store</button>
                                                    @endif

                                                </td>
                                                <td>
                                                    <button class="btn btn-primary">Edit</button>

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


        <!-- Modal -->
        <div id="customer" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Device List</h4>
                    </div>
                    <form action="{{ route('devices-store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">

                                    <div>
                                        <label for="">Device Number</label>
                                        <input type="text" class="form-control" name="devicenumber"
                                            placeholder="ENTER LIST OF DEVICE" required>
                                        @error('devicenumber')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="">Device Type</label>
                                        <select name="" name="devicetype" class="form-control" required>
                                            <option value="1">Master</option>
                                            <option value="2">Slave</option>
                                        </select>
                                        @error('devicetype')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





    </div>

@endsection
