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
                                Create DEVICES</a>
                        </div>

                        <!-- /.box-header -->
                        <div class="ibox-body">
                            <table id="example1" class="table table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Team</th>
                                        <th>Department</th>
                                        <th>Position</th>
                                        <th>Phone</th>
                                        <th>Created_By</th>
                                        <th>Approve_by</th>
                                        <th>Status</th>
                                        <th>Approved_Status</th>
                                        <th>Date_of_create </th>
                                        <th>Time_of_create</th>
                                        <th>Date_of_approve</th>
                                        <th>Time_of_approve</th>
                                        <th>User_Activate_Date</th>


                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $dt)
                                        <tr>

                                            <td>{{ $dt->name }}</td>
                                            <td>{{ $dt->email }}</td>
                                            <td>
                                                @forelse ($dt->getRoleNames() as $role)
                                                    <label class="badge badge-success">{{ $role }}</label>
                                                @empty
                                                    <label class="badge badge-success">-</label>
                                                @endforelse
                                            </td>
                                            <td>{{ $dt->team }}</td>
                                            <td>{{ $dt->department }}</td>
                                            <td>{{ $dt->position }}</td>
                                            <td>{{ $dt->phone }}</td>
                                            <td>{{ $dt->creator->name ?? 'none' }}</td>
                                            <td>{{ $dt->approver->name ?? 'none' }}</td>
                                            <td>
                                                @if ($dt->is_active == 1)
                                                    <small class="btn-sm btn-success">Active</small>
                                                @else
                                                    <small class="btn-sm btn-danger">Disabled</small>
                                                @endif

                                            </td>
                                            <td>
                                                @if ($dt->approve_status == 1)
                                                    <small class="btn-sm btn-success">Approved</small>
                                                @else
                                                    <small class="btn-sm btn-danger">Not Approved</small>
                                                @endif
                                            </td>

                                            <td>{{ date('Y-m-d', strtotime($dt->usercreatedate)) }}</td>
                                            <td> {{ date('H:i:s', strtotime($dt->usercreatedate)) }}</td>

                                            <td>{{ date('Y-m-d', strtotime($dt->approved_date)) }}</td>
                                            <td> {{ date('H:i:s', strtotime($dt->approved_date)) }}</td>
                                            <td>{{ $dt->enable_date }}</td>


                                            <td class="text-center">

                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success">Action</button>
                                                    <button type="button" class="btn btn-success dropdown-toggle"
                                                        data-toggle="dropdown">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li>
                                                            <a href="{{ url('users-edit', $dt->uid) }}"> <i
                                                                    class="fa fa-edit"></i> Edit Details</a>

                                                        </li>
                                                        <li>
                                                            @if ($dt->is_active == 1)
                                                                <a href="" type="button" data-toggle="modal"
                                                                    data-target="#disable-user{{ $dt->uid }}"> <i
                                                                        class="fa fa-edit"></i> Disable</a>
                                                            @else
                                                                <a href="" type="button" data-toggle="modal"
                                                                    data-target="#enable-user{{ $dt->uid }}"> <i
                                                                        class="fa fa-edit"></i> Activate</a>
                                                            @endif

                                                        </li>
                                                        <li>
                                                            @if ($dt->approve_status == 0)
                                                                <a href="" type="button" data-toggle="modal"
                                                                    data-target="#approve-user{{ $dt->uid }}"> <i
                                                                        class="fa fa-edit"></i> Approve User</a>
                                                            @endif

                                                        </li>

                                                        @if ($dt->team_id)
                                                            <li>
                                                                <a href="" type="button" data-toggle="modal"
                                                                    data-target="#changeteam{{ $dt->uid }}"> <i
                                                                        class="fa fa-edit"></i> Change Team</a>
                                                            </li>
                                                        @endif

                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>

                                        <div id="disable-user{{ $dt->uid }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Disable User</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

                                                    </div>
                                                    <form method="POST" action="{{ url('disable-user', $dt->uid) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $dt->uid }}">
                                                            <span>Are you Sure you want to Disable</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Disable</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="enable-user{{ $dt->uid }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Enable User</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

                                                    </div>
                                                    <form method="POST"
                                                        action="{{ url('enable-user/' . $dt->uid) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $dt->uid }}">
                                                            <span>Are you Sure you want to Enable</span>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Enable</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="approve-user{{ $dt->uid }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Approve User</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

                                                    </div>
                                                    <form method="POST"
                                                        action="{{ url('approve-user/' . $dt->uid) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ $dt->uid }}">
                                                            <span>Are you Sure you want to Approve This
                                                                User-</span><strong>{{ $dt->name }}</strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Enable</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <div id="changeteam{{ $dt->uid }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Change Team</h4>
                                                        <button type="button" class="close"
                                                            data-dismiss="modal">&times;</button>

                                                    </div>
                                                    <form method="POST"
                                                        action="{{ url('change-user-team/' . $dt->uid) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <input type="hidden" name="user_id"
                                                                value="{{ $dt->uid }}">

                                                            <div class="row">
                                                                <div class="form-group col-md-12">
                                                                    <label for="sel1">Team To</label>
                                                                    <select name="team_id" class="form-control">
                                                                        <option value="2">~~Select Team~~</option>
                                                                        @foreach ($teamlist as $key => $type)
                                                                            <option value="{{ $key }}">
                                                                                {{ $type }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Change</button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
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




    <!-- Modal -->
    <div id="customer" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User</h4>
                </div>
                <form action="{{ route('user-store') }}" method="POST">
                    @csrf
                    <div class="container row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" class="form-control" name="name">
                            </div>
                            @error('name')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="container col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Email:</strong>
                                <input type="email" class="form-control" name="email">
                            </div>
                            @error('email')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row container">
                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Password:</strong>
                                <input type="password" class="form-control" name="password">
                            </div>
                            @error('password')
                                <p class="text-danger">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Confirm Password:</strong>
                                <input type="password" class="form-control" name="confirm-password">
                                @error('confirm-password')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row container">
                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input type="tel" class="form-control" name="phone">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Position:</strong>
                                <input type="text" class="form-control" name="position">
                            </div>
                        </div>
                    </div>

                    <div class="row container">
                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Department</strong>
                                <select name="department_id" class="form-control select2"
                                    data-placeholder="Select Department" style="width: 100%;">
                                    <option value=" ">[SELECT]</option>
                                    @foreach ($depat as $key => $type)
                                        <option value="{{ $key }}">{{ $type->dept_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <strong>Gender</strong>
                                <select name="sex" class="form-control select2"
                                    data-placeholder="Select a Gender" style="width: 100%;">
                                    <option value=" ">[SELECT]</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>


                        </div>
                    </div>




                    <div class="row container">

                        <div class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Team</label>
                                <select name="team_id" class="form-control select2" data-placeholder="Select a Team"
                                    id="team_id" style="width: 100%;">
                                    <option value=" ">[SELECT]</option>
                                    @foreach ($teamlist as $key => $type)
                                        <option value="{{ $type->id }}">{{ $type->team_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div id="location" class=" col-xs-12 col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Location</label>
                                <select name="location_id" class="form-control select2"
                                    data-placeholder="Select a Border" style="width: 100%;">
                                    <option value=" ">[SELECT]</option>
                                    <option value="">Border</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row container">
                        <div class=" col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Role:</strong>
                                <select name="role" class="form-control select2"
                                    data-placeholder="Select a Border" style="width: 100%;">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }} ">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>



                    <div class="box-footer">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
