<!DOCTYPE html>
<html lang="en">

<head>
    <title>cash receipt</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        hr.new2 {
            border-top: 1px dashed black;
            margin-left: auto;
            margin-right: auto;
            margin: 3px;
        }

        body {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            /*border: 1px solid black;*/
            margin-left: auto;
            margin-right: auto;
        }

        table td,
        th {
            /*border: 1px solid black;*/
            /*padding: 3px;*/

        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>

</head>

<body>

    <button class="no-print btn btn-success" onclick="window.print();">Print</button>
    {{-- <a class="no-print btn btn-warning" href="{{ route('leasing') }}">BACK TO LEASING</a> --}}


    @foreach ($leases as $key => $billsale)
        <table cellspacing="0">
            <tr>
                <td style="text-align: center;">
                    <p>*-**[ SALES RECEIPT ] **-*</p><br>
                </td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <center>
                        <b>EQUPOINT PROPERTY LTD</b><br>
                        ---* Our Office Contacts *---<br>
                        sales@equpointproperty.co.tz<br>
                        +255656883888/+255752335555<br>
                        +255785883888<br>
                        ---* TMU-TRA Helpdesk *---<br>
                        +255222292088/+255222292089<br>
                        +255735222514 <br>
                        ---*****---<br>

                    </center>
                </td>
            </tr>
            <tr>
                <?php $master = $billsale->master->Devicenumber; ?>
                <?php $slave = []; ?> <!-- Initialize $slave as an array -->

                @if ($billsale->devices->isNotEmpty())
                    <?php $slaveNumbers = ''; ?>
                    @foreach ($billsale->devices as $slave)
                        <?php $slaveNumbers .= $slave->Devicenumber . "\n"; ?>
                    @endforeach
                    <td style="text-align: center;"> {!! QrCode::size(70)->generate($master . "\n" . $slaveNumbers) !!}</td>
                @else
                    <td style="text-align: center;"> {!! QrCode::size(70)->generate($master) !!}</td>
                @endif

                {{-- <td> {{ $slave }}</td> --}}
                {{-- <td style="text-align: center;"> {!! QrCode::size(70)->generate($master . "\n" . $slaveId) !!}</td> --}}


            </tr>
        </table>
        <!-- RECEIPT # -->
        <table cellspacing="0">
            <tr>
                <td>RECEIPT NUMBER</td>
                <td>:</td>
                <td class="bill_number" style="text-align:right"><b>{{ $billsale->lease_number }}</b>
                </td>
            </tr>

        </table>
        <hr class="new2">
        <table cellspacing="0">
            <tr>
                <td>Printed By</td>
                <td>:</td>
                <td style="text-align:right"><small><i>{{ $billsale->tager->name }}</></i></small></td>
            </tr>
        </table>
        <hr class="new2">

        <!-- client details -->
        <table cellspacing="0">
            <tr>
                <td>ClientName</td>
                <td>:</td>
                <td style="text-align:right"><b>{{ $billsale->customer_name ?? $billsale->customer->compy_name }}</b>
                </td>
            </tr>


        </table cellspacing="0">
        <hr class="new2">
        <!-- unit details -->
        <table cellspacing="0">
            {{-- {{ $billsale->devices }} --}}
            @if ($billsale->devices === null || $billsale->devices->isEmpty())
                <tr>
                    <td>Master#</td>
                    <td>:</td>
                    <td></td>
                    <td style="text-align:right">
                        <h4><strong>{{ $billsale->master->Devicenumber }}</strong></h4>
                    </td>

                </tr>
            @else
                <tr>
                    <td>Master#</td>
                    <td>:</td>

                    <td style="text-align:right">
                        <h4><strong>{{ $billsale->master->Devicenumber }}</strong></h4>
                    </td>

                </tr>
                <tr>
                    <td>Slaves#</td>
                    <td>:</td>

                    @foreach ($billsale->devices as $slave)
                        <td style="font-size:15px;width:5px"><strong>{{ $slave->Devicenumber }}</strong>
                    @endforeach
                    <td style="font-size:15px;width:5px"><strong>{{ $billsale->slavename }}</strong></td>


                </tr>
            @endif
        </table>
        <hr class="new2">
        <!-- client Details -->
        <table cellspacing="0">
            <tr>
                <td>SubT1 #</td>
                <td>:</td>
                <td style="text-align:right;">{{ $billsale->subT1 }}</td>
            </tr>
            @if ($billsale->cargo_type == 3)
                <tr>
                    <td>ChasisNo #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->chasis_number }}</td>
                </tr>

                <tr>
                    <td>IT #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->It_number }}</td>

                </tr>
            @elseif($billsale->cargo_type == 1)
                <tr>
                    <td>Truck #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->truck_number }}</td>
                </tr>
                <tr>
                    <td>Trailer #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->trailer_number }}</td>

                </tr>
            @elseif($billsale->cargo_type == 2)
                {{-- <tr>
                    <td>Container #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->container_no }}</td>
                </tr> --}}
                <tr>
                    <td>Truck #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->truck_number }}</td>
                </tr>
                <tr>
                    <td>Trailer #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->trailer_number }}</td>

                </tr>
            @elseif($billsale->cargo_type == 4)
                <tr>
                    <td>Truck #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->truck_number }}</td>
                </tr>
                <tr>
                    <td>Trailer #</td>
                    <td>:</td>
                    <td style="text-align:right">{{ $billsale->trailer_number }}</td>
                </tr>
            @endif
            <tr>
                <td>DriverName</td>
                <td>:</td>
                <td style="text-align:right">{{ $billsale->driver_name }}</td>
            </tr>
            <tr>
                <td>DriverPhone</td>
                <td>:</td>
                <td style="text-align:right">{{ $billsale->driver_phone }}</td>
            </tr>
            <tr>
                <td>Passport/DL</td>
                <td>:</td>
                <td style="text-align:right">{{ $billsale->driver_licence }}</td>
            </tr>

            <tr>
                <td>CargoType</td>
                <td>:</td>
                <td style="text-align:right">
                    @if ($billsale->cargo_type == 1)
                        LOOSE CARGO
                    @elseif($billsale->cargo_type == 2)
                        CONTAINERIZED
                    @elseif($billsale->cargo_type == 3)
                        IT
                    @elseif($billsale->cargo_type == 4)
                        TANKER
                    @else
                        OTHER CARGO
                    @endif
                </td>
            </tr>

            <tr>
                <td>Agent Name</td>
                <td>:</td>
                <td style="text-align:right;font-size:12px">
                    {{ $billsale->customer_name ?? $billsale->customer->compy_name }}</td>
            </tr>
            <tr>
                <td>Destination</td>
                <td>:</td>
                <td style="text-align:right">{{ $billsale->border->name }}</td>
            </tr>
        </table>
        <hr class="new2">

        <!-- payement details -->
        <table cellspacing="0">
            <tr>
                <td>Amount</td>
                <td>:</td>
                <td style="text-align:right">
                    {{ $billsale->master_price + $billsale->slave_price }}
                </td>

            </tr>
            <tr>
                <td>Payment Mode</td>
                <td>:</td>
                <td style="text-align:right">
                    @if ($billsale->lease_type == 1)
                        CASH
                    @else
                        CASH PENDING
                    @endif

                </td>
            </tr>
        </table>
        <hr class="new2">

        <table cellspacing="0">
            <tr>
                <td>Tagged By</td>
                <td>:</td>
                <td style="text-align:right">{{ $billsale->tager->name }}</td>
            </tr>
            <tr>
                <td>Tag Area</td>
                <td>:</td>
                <td style="text-align:right">
                    {{ $billsale->tag->tag_name }}

                </td>
            </tr>
        </table>
        <hr class="new2">

        <table cellspacing="0">
            <tr>
                <td style="font-size:12px">
                    <P>The Rental of This Device(s) is Valid in (7) days:
                        <b><i>From {{ $billsale->created_at }} TO
                                {{ Carbon\Carbon::parse($billsale->created_at)->addWeek() }}</i></b>
                    </P>
                </td>
            </tr>
            <tr>
                <td style="font-size:12px">
                    <i>** Terms and Condition Apply.**</i>
                    <p align="center">Thanks for choose Us</p>
                </td>
            </tr>
        </table>
        <div class="mt-5">
        </div>
    @endforeach


</body>

<script language="JavaScript">
    function netPrintBillInline() {
        let dynHtml = "print://escpos.org/escpos/net/print?srcTp=uri&srcObj=html&src='data:text/html,";
        dynHtml += document.body.innerHTML
        dynHtml += "'";
        window.location.href = dynHtml;
    }

    function btPrintBillInline() {
        let dynHtml = "print://escpos.org/escpos/bt/print?srcTp=uri&srcObj=html&numCopies=1&src='data:text/html,";
        dynHtml += document.body.innerHTML
        dynHtml += "'";
        window.location.href = dynHtml;
    }

    function usbPrintBillInline() {
        let dynHtml = "print://escpos.org/escpos/usb/print?srcTp=uri&srcObj=html&src='data:text/html,";
        dynHtml += document.body.innerHTML
        dynHtml += "'";
        window.location.href = dynHtml;
    }

    function netPrintBillUrl() {
        let dynHtml = "print://escpos.org/escpos/net/print?srcTp=uri&srcObj=html&src='";
        dynHtml += "https://loopedlabs.com/web-print/bill.html";
        dynHtml += "'";
        window.location.href = dynHtml;
    }

    function btPrintBillUrl() {
        let dynHtml = "print://escpos.org/escpos/bt/print?srcTp=uri&srcObj=html&src='";
        var bill_array = [];
        document.querySelectorAll(".bill_number").forEach(function(item) {
            bill_array.push(item.innerText);
        })
        console.log(bill_array);
        var array = encodeURIComponent(JSON.stringify(bill_array));
        url = window.location.origin + "/api/sales_bill_cash_info_array/?bill_array=" + array;
        console.log(url);
        dynHtml += url + "'";
        window.location.href = dynHtml;
    }

    function usbPrintBillUrl() {
        let dynHtml = "print://escpos.org/escpos/usb/print?srcTp=uri&srcObj=html&src='";
        dynHtml += "https://loopedlabs.com/web-print/bill.html";
        dynHtml += "'";
        window.location.href = dynHtml;
    }
</script>

</html>
