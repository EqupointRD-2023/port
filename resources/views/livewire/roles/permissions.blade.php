@extends('layouts.main')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="mt-0 header-title">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Library</li>
                                    </ol>
                                </nav>
                            </h4>
                            <div class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    Create Permission
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table id="order-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $key => $permission)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success dropdown-toggle" type="button"
                                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="#">Edit</a></li>
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div> <!-- end row -->




        </div> <!-- container-fluid -->
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id='submit-permission-form'>
                            @csrf
                            <div>
                                <label for="">Name</label>
                                <input type="text" class="form-control" name='name'>
                                @error('name')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit-permission" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>










        <!-- Modal -->
        {{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST"  action="{{ route('permission-store') }}" >
                            @csrf
                            <div>
                                <label for="">Name</label>
                                <input type="text" id="name-permission" class="form-control" name='name' value="">
                                @error('name')
                                    <p id="message-error" class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submit-permission" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div> <!-- content --> --}}
@endsection
@section('script')
<script>
    var urlPost = <?php echo route("permission-store")?>
    var name = document.getElementById("name-permission");
    $.ajax({
        type: "POST",
        url: urlPost,
        data: {id:"someid"},
        dataType: "application/json",
        success: function (response) {
            var messageSuccess = JSON.parse(response);

            alert(messageSuccess['message'])
        },
        error:function(error){

        }
    });
</script>
@endsection
