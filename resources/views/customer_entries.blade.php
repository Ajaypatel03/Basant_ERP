@extends('header')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customer Entries</h3>
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                            Add Customer Entries
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
                                    <h4 class="modal-title">Add Customer Entries</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customerEntries.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Date</label>
                                                <input type="date" id="date" class="form-control" name="date">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="customer_id">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control">
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="items">Items</label>
                                                <input type="text" id="items" class="form-control" name="items"
                                                    placeholder="Sugar,Oil..etc">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_due">Amount Due</label>
                                                <input type="text" id="amount_due" class="form-control" name="amount_due"
                                                    placeholder="1000">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_paid">Amount Paid</label>
                                                <input type="text" id="amount_paid" class="form-control"
                                                    name="amount_paid" placeholder="500">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="type">Payment Type</label>
                                                <input type="text" id="type" class="form-control" name="type"
                                                    placeholder="Cash/Online">
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
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Items</th>
                                                <th>Amount Due</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($customerEntries->isEmpty())
                                                <tr>
                                                    <td colspan="10" class="text-center text-danger">No Customer Entries
                                                        Added
                                                        Yet</td>
                                                </tr>
                                            @else
                                                @php $serial = 1 @endphp
                                                @foreach ($customerEntries as $customerEntry)
                                                    <tr>
                                                        <td class="text-center">{{ $serial }}</td>
                                                        <td class="text-center">{{ $customerEntry->date }}</td>
                                                        <td class="text-center">
                                                            {{ $customerEntry->customer->name ?? 'N/A' }}</td>
                                                        <td class="text-center">{{ $customerEntry->items }}</td>
                                                        <td class="text-red text-right">₹{{ $customerEntry->amount_due }}
                                                        </td>
                                                        <td class="text-green text-right">
                                                            ₹{{ $customerEntry->amount_paid ?? '-' }}</td>
                                                        <td class="text-center">{{ $customerEntry->type }}</td>
                                                        <td
                                                            style=" display:flex; justify-content:center;align-items:center">
                                                            <a href="{{ route('customerEntries.edit', $customerEntry->id) }}"
                                                                class="text-info"><span
                                                                    class="fa fa-pencil text-center"></span></a>
                                                            <form method="POST"
                                                                action="{{ route('customerEntries.destroy', $customerEntry->id) }}"
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
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="text-right">Total Amount Due: <span
                                                        class="text-red">₹{{ $totalAmountDue }}</span>
                                                </th>
                                                <th class="text-right">Total Amount Paid: <span
                                                        class="text-green">₹{{ $totalAmountPaid }}</span> </th>
                                                <th></th>
                                            </tr>
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
