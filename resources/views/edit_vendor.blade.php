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
                                    <h4 class="modal-title">Edit Vendor Details</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('vendor.update', $vendor->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="name">Name</label>
                                                <input type="text" id="v_name" class="form-control" name="v_name"
                                                    value="{{ $vendor->v_name }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="mobile">Mobile No.</label>
                                                <input type="number" id="v_mobile" class="form-control" name="v_mobile"
                                                    value="{{ $vendor->v_mobile }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="address">Address</label>
                                                <input type="text" id="v_address" class="form-control" name="v_address"
                                                    value="{{ $vendor->v_address }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="bank">Bank Name</label>
                                                <input type="text" id="v_bank_name" class="form-control"
                                                    name="v_bank_name" value="{{ $vendor->v_bank_name }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="bank_acc_no">Bank Account No.</label>
                                                <input type="text" id="v_bank_acc_no" class="form-control"
                                                    name="v_bank_acc_no" value="{{ $vendor->v_bank_acc_no }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="ifsc">Bank IFSC No.</label>
                                                <input type="text" id="v_ifsc" class="form-control" name="v_ifsc"
                                                    value="{{ $vendor->v_ifsc }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="location">Bank Location No.</label>
                                                <input type="text" id="v_bank_location" class="form-control"
                                                    name="v_bank_location" value="{{ $vendor->v_bank_location }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Vendor</button>
                                        <a href="{{ route('vendor.index') }}" class="btn btn-primary pull-right">Go
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
