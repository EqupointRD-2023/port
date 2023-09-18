@extends('layouts.main') @section('content')
    <br>
    <br>

    <form action="{{ route('lease-receipt-many') }}" method="post">
        @csrf
        <div class="row">
            <button type="submit" class="btn btn-danger" id="Print_All">PRINT ALL</button>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table table-bordered">

                <thead>
                    <tr style="font-size: 0.78em;">
                        <th>#</th>

                        <th><input type="checkbox" id="check_all"></th>
                        <th>RECEIPT_#</th>
                        <th>REFER_STATUS</th>
                        {{-- <th>CANCEL_STATUS</th> --}}
                        <th>DEVICE#</th>
                        <th>SLAVE#</th>
                        <th>COMPANY_NAME</th>
                        <th>TRUCK_NUMBER</th>
                        <th>TRAILER#</th>
                        <th>IT#</th>
                        <th>CARGO_TYPE</th>
                        <th>DRIVER_NAME</th>
                        <th>DRIVER_#</th>
                        <th>TAGGED_BY</th>
                        <th>TAGGED_AREA</th>
                        <th>DESTINATION</th>
                        <th>TAG_DATE</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $key => $dt)
                        <tr style="font-size:0.78em;">

                            <td> {{ ++$key }} </td>
                            <td><input type="checkbox" name="lease_number[]" class="checkbox"
                                    value="{{ $dt->lease_number }}">
                            </td>

                            <td>{{ $dt->lease_number }}</td>
                            <td>
                                {{-- <button class="btn-xs btn-danger">REPLACED</button> --}}
                            </td>
                            {{-- <td>
                            @if ($dt->cancel_bill == 1)
                                <button class="btn-xs btn-danger">CANCELED</button>
                            @else
                            @endif
                        </td> --}}
                            <td>{{ $dt->master->Devicenumber }}</td>
                            {{-- <td>[{{ $dt->totalslave }}]={{ $dt->slavename }}</td> --}}
                            <td>
                                @foreach ($dt->devices as $key => $slave)
                                    <?php $totalkeys = $key + 1; ?>
                                    {{ $slave->Devicenumber }}
                                @endforeach
                            </td>
                            <td>{{ $dt->customer_name ?? $dt->customer->compy_name }}</td>
                            <td>{{ $dt->truck_number }}</td>
                            <td>{{ $dt->trailer_number }}</td>
                            <td>{{ $dt->it_number }}</td>
                            <td>
                                @if ($dt->cargo_type == 1)
                                    LOOSE CARGO
                                @elseif($dt->cargo_type == 2)
                                    CONTAINERIZED
                                @elseif($dt->cargo_type == 3)
                                    IT
                                @elseif($dt->cargo_type == 4)
                                    TANKER
                                @else
                                    OTHER CARGO
                                @endif
                            </td>
                            <td>{{ $dt->driver_name }}</td>
                            <td>{{ $dt->driver_phone }}</td>
                            <td>{{ $dt->tager->name }}</td>
                            <td>{{ $dt->tag->tag_name }}</td>
                            <td>{{ $dt->border->name }}</td>
                            <td>{{ $dt->created_at }}</td>

                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </form>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
@endsection
