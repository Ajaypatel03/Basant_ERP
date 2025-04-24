@extends('header')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vendors Entries</h3>
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                            Add Vendor Entries
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
                                    <h4 class="modal-title">Add Vendor Entries</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('vendorEntries.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Date</label>
                                                <input type="date" id="date" class="form-control" name="date">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="due_date">Due Date</label>
                                                <input type="date" id="due_date" class="form-control" name="due_date">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="vendor_id">Vendor Name</label>
                                                <select name="vendor_id" id="vendor_id" class="form-control">
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}">{{ $vendor->v_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="bill_no">Bill No.</label>
                                                <input type="text" id="bill_no" class="form-control" name="bill_no"
                                                    placeholder="Abc123">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="image">Image</label>
                                                <input type="file" id="image" class="form-control" name="image">
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

                    <!-- Image Preview Modal -->
                    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="imageModalLabel">Image View</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    @foreach ($vendorEntries as $entry)
                                        @if ($entry->image)
                                            <img src="{{ asset('images/' . $entry->image) }}" alt="Vendor Image"
                                                style="width: 100%;">
                                        @else
                                            <img src="{{ asset('images/download.png') }}" alt="Default Image"
                                                style="width: 100%;">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable"
                                        role="grid" aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Serial No.</th>
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Vendor Name</th>
                                                <th>Bill No.</th>
                                                <th>Image</th>
                                                <th>Amount Due</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($vendorEntries->isEmpty())
                                                <tr>
                                                    <td colspan="10" class="text-center text-danger">No Vendors Entries
                                                        Added Yet</td>
                                                </tr>
                                            @else
                                                @php $serial = 1 @endphp
                                                @foreach ($vendorEntries as $vendorEntry)
                                                    <tr>
                                                        <td>{{ $serial }}</td>
                                                        <td>{{ $vendorEntry->date }}</td>
                                                        <td>{{ $vendorEntry->due_date }}</td>
                                                        <td>{{ $vendorEntry->vendor->v_name ?? 'N/A' }}</td>
                                                        <td>{{ $vendorEntry->bill_no }}</td>
                                                        <td class="text-center" style="width: 10%;">
                                                            <img src="{{ asset($vendorEntry->image ? 'images/' . $vendorEntry->image : 'images/download.png') }}"
                                                                alt="Vendor Image" style="width: 100%; cursor: pointer;"
                                                                data-toggle="modal" data-target="#imageModal"
                                                                data-image="{{ asset($vendorEntry->image ? 'images/' . $vendorEntry->image : 'images/download.png') }}">
                                                        </td>
                                                        <td class="text-red text-right">₹{{ $vendorEntry->amount_due }}
                                                        </td>
                                                        <td class="text-green text-right">
                                                            ₹{{ $vendorEntry->amount_paid ?? '-' }}</td>
                                                        <td>{{ $vendorEntry->type }}</td>
                                                        <td
                                                            style="display:flex; justify-content:center;align-items:center">
                                                            <a href="{{ route('vendorEntries.edit', $vendorEntry->id) }}"
                                                                class="text-info">
                                                                <span class="fa fa-pencil text-center"></span>
                                                            </a>
                                                            <form method="POST"
                                                                action="{{ route('vendorEntries.destroy', $vendorEntry->id) }}"
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
                                                <th colspan="6"></th>
                                                <th>Total Amount Due: <span class="text-red">₹{{ $totalAmountDue }}</span>
                                                </th>
                                                <th>Total Amount Paid: <span
                                                        class="text-green">₹{{ $totalAmountPaid }}</span></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-7"></div>
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

    <script>
        $('#imageModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var imageUrl = button.data('image'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-body img').attr('src', imageUrl);
        });
    </script>
@endsection
