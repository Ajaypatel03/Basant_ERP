@extends('header')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer Data Table</h3>
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                            Add Customer
                        </button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('alert-success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong> {{ Session::get('alert-success') }}
                        </div>
                    @endif

                    <!-- /.box-header -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Customer</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customer.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="Name">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile No.</label>
                                                <input type="number" id="mobile" class="form-control" name="mobile"
                                                    placeholder="90981xxxxx">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" class="form-control" name="address"
                                                    placeholder="Dewas">
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Serial No.</th>
                                                <th>Name</th>
                                                <th>Mobile No.</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($customers->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center text-danger">No customers Added
                                                        Yet</td>
                                                </tr>
                                            @else
                                                @php $serial = 1 @endphp
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td>{{ $serial }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>{{ $customer->mobile }}</td>
                                                        <td>{{ $customer->address }}</td>
                                                        <td
                                                            style=" display:flex; justify-content:center;align-items:center">
                                                            <a href="{{ route('customer.edit', $customer->id) }}"
                                                                class="text-info"><span
                                                                    class="fa fa-pencil text-center"></span></a>
                                                            <form method="POST"
                                                                action="{{ route('customer.destroy', $customer->id) }}"
                                                                class="inner">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"><a
                                                                        class="text-danger mr-3 text-center"><span
                                                                            class="fa fa-trash"></span></a></button>
                                                            </form>
                                                        </td>

                                                    </tr>
                                                    @php $serial++ @endphp
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">

                                </div>
                                <div class="col-sm-7">

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
@endsection
