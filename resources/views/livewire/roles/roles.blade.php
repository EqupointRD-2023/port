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
                            <a href="" type="button" class="btn btn-success  pull-right" data-toggle="modal"
                                data-target="#customer">
                                Create Role</a>
                        </div>

                        <!-- /.box-header -->
                        <div class="ibox-body">
                            <table id="example1" class="table table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $dt)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $dt->name }}</td>
                                            <td>
                                                <button class="btn btn-primary">Edit</button>
                                                <button class="btn btn-danger">Delete</button>
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
                            <form action="{{ route('role-store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div>
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="name" placeholder=""
                                                    required>
                                                @error('name')
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
        </div>
    </div>
</div>
