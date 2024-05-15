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
                                    <h4 class="modal-title">Edit Customer</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ $customer->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile No.</label>
                                            <input type="number" id="mobile" class="form-control" name="mobile"
                                                value="{{ $customer->mobile }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" id="address" class="form-control" name="address"
                                                value="{{ $customer->address }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Customer</button>
                                        <a href="{{ route('customer.index') }}" class="btn btn-primary pull-right">Go
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
