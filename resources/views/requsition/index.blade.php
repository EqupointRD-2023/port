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

        <!-- /.col -->
        <div class="col-md-12">

            <div class="page-content fade-in-up">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ibox">
                            {{-- <div class="ibox-head">
                                <div class="ibox-title">Requisitions</div>
                                <a href="" type="button" class="btn btn-success  pull-right" data-toggle="modal"
                                    data-target="#customer">
                                    Request Device</a>
                            </div> --}}

                            <!-- /.box-header -->
                            <div class="ibox-body">
                                <table id="example1" class="table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Requisition Number</th>
                                            <th>Requester</th>
                                            <th>Purpose</th>
                                            <th>Quantity</th>

                                            <th class="text-center">action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($requisitions as $key => $dt)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $dt->requisitionNumber }}</td>
                                                <td>{{ $dt->user->name }}</td>
                                                <td>{{ $dt->purpose }}</td>
                                                <td>{{ $dt->quantity }}</td>

                                                <td class="d-flex text-center">


                                                    @if ($dt->status == 0)
                                                        <div class="dropdown">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                data-toggle="dropdown">Action
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <form action="{{ route('requsition-update', $dt->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button class="button-like-text"
                                                                        style="border: none; background:none">Acknowledge</button>

                                                                </form>
                                                                <form action="{{ route('requsition-cancel', $dt->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button class="button-like-text"
                                                                        style="border: none; background:none">Cancel</button>

                                                                </form>
                                                            </ul>
                                                        </div>
                                                    @elseif ($dt->status == 1)
                                                        <button class="btn btn-success">
                                                            Accepted
                                                        @else
                                                            <button class="btn btn-danger">
                                                                Canceled
                                                            </button>
                                                    @endif


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

                    <div id="customer" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Device List</h4>
                                </div>
                                <form action="{{ route('requsition-store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div>
                                                    <label for="">Quantity</label>
                                                    <input type="number" class="form-control" name="quantity"
                                                        placeholder="" required>
                                                    @error('quantity')
                                                        <p class="text-danger">
                                                            {{ $message }}
                                                        </p>
                                                    @enderror
                                                </div>


                                                <div>
                                                    <label for="">purpose</label>
                                                    <select name='purpose' class="form-control">
                                                        <option value="Sale">Sale</option>
                                                        <option value="Demo">Demo</option>
                                                    </select>
                                                    @error('purpose')
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
                                        <button type="submit" class="btn btn-primary">Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
