@extends('header')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="modal fade in" id="modal-default"
                        style="display: block; padding-right: 17px;padding-top:50px;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit vendor Entries</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('vendorEntries.update', $vendorEntries->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Date</label>
                                                <input type="date" id="date" class="form-control" name="date"
                                                    value="{{ $vendorEntries->date }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="date">Due Date</label>
                                                <input type="date" id="due_date" class="form-control" name="due_date"
                                                    value="{{ $vendorEntries->due_date }}">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="vendor_id">Vendor Name</label>
                                                <select name="vendor_id" id="vendor_id" class="form-control">
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->id }}"
                                                            {{ $vendor->id == $vendorEntries->vendor_id ? 'selected' : '' }}>
                                                            {{ $vendor->v_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="items">Bill No.</label>
                                                <input type="text" id="bill_no" class="form-control" name="bill_no"
                                                    value="{{ $vendorEntries->bill_no }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="image">Image</label>
                                                <input type="file" id="image" class="form-control" name="image"
                                                    value="{{ $vendorEntries->image }}">
                                                <img src="{{ asset($vendorEntries->image ? 'images/' . $vendorEntries->image : 'images/download.png') }}"
                                                    alt="" style="width: 20%;">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_due">Amount Due</label>
                                                <input type="text" id="amount_due" class="form-control" name="amount_due"
                                                    value="{{ $vendorEntries->amount_due }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_paid">Amount Paid</label>
                                                <input type="text" id="amount_paid" class="form-control"
                                                    name="amount_paid" value="{{ $vendorEntries->amount_paid }}">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary pull-right">Update Vendor</button>
                                        <a href="{{ route('vendorEntries.index') }}" class="btn btn-primary">Go
                                            Back</a>
                                    </form>


                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                    </div>


                    <!-- /.box -->
                    <!-- /.col -->
                </div>
                <!-- /.row -->
    </section>
@endsection
