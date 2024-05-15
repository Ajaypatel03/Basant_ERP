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
                                    <h4 class="modal-title">Edit Customer Entries</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customerEntries.update', $customerEntries->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Date</label>
                                                <input type="date" id="date" class="form-control" name="date"
                                                    value="{{ $customerEntries->date }}">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="customer_id">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control">
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach ($customers as $customer)
                                                        <option value="{{ $customer->id }}"
                                                            {{ $customer->id == $customerEntries->customer_id ? 'selected' : '' }}>
                                                            {{ $customer->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="items">Items</label>
                                                <input type="text" id="items" class="form-control" name="items"
                                                    value="{{ $customerEntries->items }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_due">Amount Due</label>
                                                <input type="text" id="amount_due" class="form-control" name="amount_due"
                                                    value="{{ $customerEntries->amount_due }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="amount_paid">Amount Paid</label>
                                                <input type="text" id="amount_paid" class="form-control"
                                                    name="amount_paid" value="{{ $customerEntries->amount_paid }}">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="type">Payment Type</label>
                                                <input type="text" id="type" class="form-control" name="type"
                                                    value="{{ $customerEntries->type }}">
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Customer</button>
                                        <a href="{{ route('customerEntries.index') }}" class="btn btn-primary pull-right">Go
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
