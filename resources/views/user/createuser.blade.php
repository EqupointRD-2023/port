@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h1 class="page-title">User </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><i class="la la-home font-20"></i></a>
            </li>
            <!-- <li class="breadcrumb-item">Customer Form</li> -->
        </ol>
    </div>

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

    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="page-content fade-in-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ibox">
                                <div class="ibox-head">
                                    <div class="ibox-title">Setting Folder</div>

                                </div>
                                <div class="ibox-body">
                                    <ul class="list-group list-group-bordered">
                                        <li class="list-group-item ">
                                            <a class="" href="{{ route('users') }}">Manage Users</a>
                                        </li>
                                        <li class="list-group-item ">
                                            <a class="" href="{{ route('roles') }}">Manage Role</a>
                                        </li>
                                    </ul>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /. box -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-head">
                        <h5>Create New User</h5>
                    </div>
                    <div class="ibox-body">


                        {!! Form::open(['route' => 'users.store', 'method' => 'POST']) !!}
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Phone:</strong>
                                    {!! Form::text('phone', null, ['placeholder' => '255719260602', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <strong>Postion:</strong>
                                    {!! Form::text('position', null, ['placeholder' => 'Position', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select name="department_id" class="form-control select2"
                                        data-placeholder="Select a Team" style="width: 100%;">
                                        <option value=" ">[SELECT]</option>
                                        @foreach ($depat as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="sex" class="form-control select2" data-placeholder="Select a Gender"
                                        style="width: 100%;">
                                        <option value=" ">[SELECT]</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Team</label>
                                    <select name="team_id" class="form-control select2" data-placeholder="Select a Team"
                                        id="team_id" style="width: 100%;">
                                        <option value=" ">[SELECT]</option>
                                        @foreach ($teamlist as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="location" class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Location</label>
                                    <select name="location_id" class="form-control select2"
                                        data-placeholder="Select a Border" style="width: 100%;">
                                        <option value=" ">[SELECT]</option>
                                        @foreach ($location as $key => $type)
                                            <option value="{{ $key }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Role:</strong>
                                    {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
            <!-- /.row -->
    </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

    <!-- <script>
        function change_type() {
            $("#location").hide(); //which element you want to hide or show
            function typeofdate() {
                var type = $("#team_id").val();

                if (type == 2 || type == 3) {
                    $("#location").show();
                } else {
                    $("#location").hide();
                }

            }
        }
    </script> -->

@endsection
