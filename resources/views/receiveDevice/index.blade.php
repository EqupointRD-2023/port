@extends('layouts.main')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
    <style type="text/css">
        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url('{{ asset('images/loader.gif') }}') no-repeat center center;
            z-index: 10000;
        }
    </style>

    <div class="container">

        <br />
        <br />

        <div class="box box-warning">
            <div class="box-header with-border text-center">
                <h3 class="box-title">RECEIVE DEVICE</h3>
            </div>
            <div class="row justify-content-center align-content-center">
                <div class="col-md-8">

                    @if ($dispatch == null)
                        <div class="text-center">
                            <p>No data</p>
                        </div>
                    @else
                        @forelse ($dispatch as $dispatch)
                            <div class="card mt-4">
                                <div class="card-body">
                                    <div class="row">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="bg-primary">#</th>
                                                    <th scope="col"class="bg-primary">dispatch Number</th>
                                                    <th scope="col"class="bg-primary">Requisition Number</th>
                                                    <th scope="col"class="bg-primary">Requested Qty</th>
                                                    <th scope="col"class="bg-primary">Received Qty</th>
                                                    <th scope="col"class="bg-primary">Action</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $dispatch->dispatchNo }}</td>
                                                <td>{{ $dispatch->requisition->requisitionNumber }}</td>
                                                <td>{{ $dispatch->requisition->quantity }}</td>
                                                <td>{{ $dispatchDevice }}</td>
                                                <td>
                                                    @if ($dispatch->dispatchStatus == 0)
                                                        <form
                                                            action="{{ route('receiveDeviceToStcok', $dispatch->dispatchNo) }}"
                                                            method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">Receive</button>
                                                        </form>
                                                    @else
                                                        <button type="button" class="btn btn-success">Received</button>
                                                    @endif
                                                </td>

                                            </tr>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center">
                                <p>No data</p>
                            </div>
                        @endforelse
                    @endif
                </div>



            </div>
        </div>





    </div>
    <div id="loader"></div>

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
                                    <input type="number" class="form-control" name="quantity" placeholder="" required>
                                    @error('quantity')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>


                                <div class="mt-4">
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



                                <div class="mt-4">
                                    <label for="">Description</label>
                                    <input type="text" class="form-control" name="description" placeholder="" required>
                                    @error('quantity')
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
@endsection
