@extends('layouts.main')
@section('content')
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Create Permission
                        </button>
                    </div>

                    <table id="order-listing" class="table">
                        <thead>
                          <tr class="bg-primary text-white">
                              <th>Order #</th>
                              <th>Customer</th>
                              <th>Ship to</th>
                              <th>Base Price</th>
                              <th>Purchased Price</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>WD-61</td>
                              <td>Edinburgh</td>
                              <td>New York</td>
                              <td>$1500</td>
                              <td>$3200</td>
                              <td>
                                <label class="badge badge-info">On hold</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-62</td>
                              <td>Doe</td>
                              <td>Brazil</td>
                              <td>$4500</td>
                              <td>$7500</td>
                              <td>
                                <label class="badge badge-danger">Pending</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-63</td>
                              <td>Sam</td>
                              <td>Tokyo</td>
                              <td>$2100</td>
                              <td>$6300</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-64</td>
                              <td>Joe</td>
                              <td>Netherland</td>
                              <td>$1100</td>
                              <td>$7300</td>
                              <td>
                                <label class="badge badge-warning">Open</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-65</td>
                              <td>Edward</td>
                              <td>Indonesia</td>
                              <td>$3600</td>
                              <td>$4800</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-66</td>
                              <td>Stella</td>
                              <td>Japan</td>
                              <td>$5600</td>
                              <td>$3600</td>
                              <td>
                                <label class="badge badge-info">On hold</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-67</td>
                              <td>Jaqueline</td>
                              <td>Germany</td>
                              <td>$1100</td>
                              <td>$6300</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-68</td>
                              <td>Tim</td>
                              <td>Italy</td>
                              <td>$6300</td>
                              <td>$2100</td>
                              <td>
                                <label class="badge badge-warning">Open</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-69</td>
                              <td>John</td>
                              <td>Tokyo</td>
                              <td>$2100</td>
                              <td>$6300</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-70</td>
                              <td>Tom</td>
                              <td>Germany</td>
                              <td>$1100</td>
                              <td>$2300</td>
                              <td>
                                <label class="badge badge-danger">Pending</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-71</td>
                              <td>Aleena</td>
                              <td>New York</td>
                              <td>$1600</td>
                              <td>$3500</td>
                              <td>
                                <label class="badge badge-danger">Pending</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-72</td>
                              <td>Alphy</td>
                              <td>Brazil</td>
                              <td>$5500</td>
                              <td>$7200</td>
                              <td>
                                <label class="badge badge-warning">Open</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-73</td>
                              <td>Twinkle</td>
                              <td>Italy</td>
                              <td>$1560</td>
                              <td>$2530</td>
                              <td>
                                <label class="badge badge-warning">Open</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-74</td>
                              <td>Catherine</td>
                              <td>Brazil</td>
                              <td>$1600</td>
                              <td>$5600</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-75</td>
                              <td>Daniel</td>
                              <td>Singapore</td>
                              <td>$6800</td>
                              <td>$9800</td>
                              <td>
                                <label class="badge badge-danger">Pending</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-76</td>
                              <td>Tom</td>
                              <td>Tokyo</td>
                              <td>$1600</td>
                              <td>$6500</td>
                              <td>
                                <label class="badge badge-info">On hold</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-77</td>
                              <td>Cris</td>
                              <td>Tokyo</td>
                              <td>$2100</td>
                              <td>$6300</td>
                              <td>
                                <label class="badge badge-warning">Open</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-78</td>
                              <td>Tim</td>
                              <td>Italy</td>
                              <td>$6300</td>
                              <td>$2100</td>
                              <td>
                                <label class="badge badge-success">Closed</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-79</td>
                              <td>Jack</td>
                              <td>Tokyo</td>
                              <td>$3100</td>
                              <td>$7300</td>
                              <td>
                                <label class="badge badge-danger">Pending</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                          <tr>
                              <td>WD-80</td>
                              <td>Tony</td>
                              <td>Germany</td>
                              <td>$1100</td>
                              <td>$2300</td>
                              <td>
                                <label class="badge badge-info">On hold</label>
                              </td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="fa fa-eye text-primary"></i>View
                                </button>
                                <button class="btn btn-light">
                                  <i class="fa fa-times text-danger"></i>Remove
                                </button>
                              </td>
                          </tr>
                        </tbody>
                      </table>

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
                <form method="POST" action="{{ route('permission-store') }}">
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

                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
@section('script')

@endsection
