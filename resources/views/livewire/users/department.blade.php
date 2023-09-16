<div class="page-heading">
    <h1 class="page-title">User </h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html"><i class="la la-home font-20"></i></a>
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

        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-md-12">
                    <div class="ibox">
                        <div class="ibox-head">
                            <div class="ibox-title">User </div>
                            <a class="btn btn-success pull-right" href=""> Create
                                Deprtment</a>
                        </div>

                        <!-- /.box-header -->
                        <div class="ibox-body">
                            <table id="example1" class="table table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $key => $dt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dt->dept_name }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-primary w-50">Edit</button>

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
</div>
