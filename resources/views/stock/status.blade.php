@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span>DEVICE NUMBER</span>
                        </div>
                        <div class="col-md-6">
                            <span> <strong class="deviceNo"></strong> </span>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>Last Update</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="lastupdate"></strong> </span>
                            <span class="lstime"></span>

                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>Lat,lng</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="lat"></strong> </span>, <span> <strong class="long"></strong> </span>

                        </div>

                    </div>

                    <br>



                    <div class="row">
                        <div class="col-md-6">
                            <span>Activation Status</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="activation"></strong> </span>

                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>Trip No</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="tripNo"></strong> </span>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>activation Date</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="activationDate"></strong> </span>

                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>Destination</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="destination"></strong> </span>

                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <span>Departure</span>

                        </div>
                        <div class="col-md-6">
                            <span> <strong class="departure"></strong> </span>

                        </div>

                    </div>
                    <br>


                    <div class="row">
                        <div class="col-md-6">
                            <span class="text-center"><strong>Master Status</strong> </span>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Power</span>

                        </div>
                        <div class="col-md-6 power">


                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Back Cover</span>

                        </div>
                        <div class="col-md-6 bckstatus">



                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Lock Status</span>

                        </div>
                        <div class="col-md-6 lockstatus">

                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Lock Stuck</span>

                        </div>
                        <div class="col-md-6 lockStuck">

                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <span>illegalCard Status</span>

                        </div>
                        <div class="col-md-6 illegalCard">

                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-center"><strong>Slave Status</strong> </span>
                        </div>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped" id="tableData">
                                <thead>
                                    <tr>
                                        <th>SLAVE</th>
                                        <th>SPOWER</th>
                                        <th>SCOVER</th>
                                        <th>SROPE</th>
                                        <th>SLOCK</th>
                                        <th>SLOCKCOFF</th>
                                        <th>SREPORT</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>

    <script>
        var response = {!! json_encode($data) !!};

        $(document).ready(function() {
            var slave = response.data.slave
            let deviceNo = response.data.mDeviceID
            let lastupdate = response.data.dateTime
            let lat = response.data.latitude
            let long = response.data.longitude
            let activation = response.status
            let power = response.data.power
            let bckstatus = response.data.coverStatus
            let lockstatus = response.data.lockStatus
            let illegalCard = response.data.illegalCard
            let lockStuck = response.data.lockStuck
            let activationDate = response.activationDate
            let destination = response.destination
            let departure = response.departures
            let tripNo = response.tripNo


            var lstime = ''
            let time1 = new Date(lastupdate);
            let time2 = new Date();

            let diffInMs = time2 - time1;
            let diffInHours = diffInMs / (1000 * 60 * 60);
            let approxDiffInHours = Math.floor(diffInHours);
            if (diffInHours < 2) {
                lstime = `<span class="btn-sm btn-success">${approxDiffInHours}  h</span>`;
            } else if (diffInHours >= 2) {
                lstime =
                    `<span class="btn-sm btn-warning"> ${approxDiffInHours}   h</span>`;
            } else {
                console.log(diffInHours + ':' + diffInMinutes + ':' + diffInSeconds);
            }

            var pw = ''
            if (power == 255) {
                pw = `<span class=" btn-sm btn-danger"> <span class="glyphicon glyphicon-remove"></span> ${power}-(Charging)</span>`
            } else if (power < 90) {
                pw = `<span class=" btn-sm btn-danger"> <span class="glyphicon glyphicon-remove"></span> ${power} %</span>`

            } else if (power >= 90) {
                pw = `<span class=" btn-sm btn-success"> <span class="glyphicon glyphicon-ok"></span> ${power} %</span>`

            } else {


            }

            var bcksts = ''
            if (bckstatus == 1) {
                bcksts =
                    `<span class="btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> CLOSED OK</span>`
            } else {
                bcksts =
                    `<span class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> OPEN</span>`
            }


            var locksts = ''
            if (lockstatus == 1) {

                locksts =
                    `<span class="btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> LOCKED OK</span>`
            } else {
                locksts =
                    `<span class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> OPEN</span>`

            }

            var lockstuk = ''
            if (lockStuck == 1) {

                lockstuk =
                    `<span class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> YES, HAS LOCK STUCK</span>`
            } else {
                lockstuk =
                    `<span class="btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> NOT HAVE</span>`

            }


            var ilcard = ''
            if (illegalCard == 0) {

                ilcard =
                    `<span class="  btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> OK</span>`
            } else {
                ilcard =
                    `<span class=" btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> NOT OK</span>`
            }

            var actvatedstatus = ''
            if (activation == 'IDLE') {

                actvatedstatus =
                    `<span class="  btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> IDLE</span>`
            } else if (activation == 'IN TRANSIT') {
                actvatedstatus =
                    `<span class=" btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span> IN TRANSIT</span>`
            }


            $(".deviceNo").html(deviceNo)
            $(".lastupdate").html(lastupdate)
            $(".lat").html(lat)
            $(".long").html(long)
            $(".activation").html(actvatedstatus)
            $(".power").html(pw)
            $(".bckstatus").html(bcksts)
            $(".lockstatus").html(locksts)
            $(".illegalCard").html(ilcard)
            $(".lockStuck").html(lockstuk)
            $(".lstime").html(lstime)

            $(".activationDate").html(activationDate)
            $(".destination").html(destination)
            $(".departure").html(departure)
            $(".tripNo").html(tripNo)

            var tbody = $('#tableData tbody');
            tbody.empty();


            for (var i = 0; i < slave.length; i++) {
                var slaveNo = slave[i].sDeviceId
                var sPower = slave[i].sPower
                var sCoverStatus = slave[i].sCoverStatus
                var sUnCoverBack = slave[i].sUnCoverBack

                var sLockRope = slave[i].sLockRope
                var sLockOpen = slave[i].sLockOpen

                var sLockCutOff = slave[i].sLockCutOff
                var sTimeOut = slave[i].sTimeOut




                var spw = ''
                if (sPower <= 79) {
                    spw =
                        `<span class="btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span>  ${sPower} </span>`
                } else if (sPower > 85) {

                    spw =
                        `<span class="btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span>  ${sPower} </span>`
                } else {

                }

                var scover = ''
                if (sCoverStatus == 1 && sUnCoverBack == 0) {
                    scover =
                        `<span class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> OK </span>`
                } else if (sCoverStatus == 0 && sUnCoverBack == 1) {
                    scover = `<span class="btn btn-sm btn-warning"> OPEN</span>`
                }

                var srope = ''
                if (sLockRope == 1) {
                    srope =
                        `<span class="btn btn-sm btn-success"><span class="glyphicon glyphicon-ok"></span> ROK </span>`
                } else if (sLockRope == 0) {
                    srope = `<span class="btn btn-sm btn-danger">ROPEN</span>`
                }


                var slckopen = ''
                if (sLockOpen == 1) {
                    slckopen =
                        `<span class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-ok"></span> OPEN </span>`
                } else if (sLockOpen == 0) {
                    slckopen = `<span class="btn btn-sm btn-success"> OK</span>`
                }

                var slockcutof = ''
                if (sLockCutOff == 1) {
                    slockcutof =
                        `<span class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-ok"></span>YES </span>`
                } else if (sLockCutOff == 0) {
                    slockcutof = ` <span class="btn btn-sm btn-success">NO</span>`

                }


                var sReport = ''
                if (sTimeOut == 1) {
                    sReport =
                        `<span class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-ok"></span> NOT REPORT </span>`
                } else if (sTimeOut == 0) {
                    sReport = `<span class="btn btn-sm btn-success"> REPORT OK</span>`
                }
                var tr = $('<tr>');
                tr.append('<td>' + slaveNo + '</td>');
                tr.append('<td>' + spw + '</td>');
                tr.append('<td>' + scover + '</td>');
                tr.append('<td>' + srope + '</td>');
                tr.append('<td>' + slckopen + '</td>');
                tr.append('<td>' + slockcutof + '</td>');
                tr.append('<td>' + sReport + '</td>');

                tbody.append(tr);
            }
        });
    </script>
@endsection
