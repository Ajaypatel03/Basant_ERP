@extends('header')
@section('styles')
    <style>
        @media print {
            .print-hidden {
                display: none;
            }
        }
    </style>
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Vendor Report</h3>
                        <a id="print-pdf"class="btn btn-warning pull-right print-hidden">Generate PDF</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{ route('vendorReport.index') }}" method="POST" class="print-hidden">
                                        @csrf
                                        <div class="form-group col-md-3">
                                            <label for="vendor_id">Select Vendor:</label>
                                            <select name="vendor_id" id="vendor_id" class="form-control">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">
                                                        {{ $vendor->v_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                        </div>
                                    </form>
                                    @if ($selectedVendor)
                                        <div>Selected Vendor: {{ $selectedVendor->v_name }}</div>
                                    @endif

                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Date</th>
                                                <th>Due Date</th>
                                                <th>Bill No.</th>
                                                <th>Amount Due</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($vendorEntries->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center text-danger">No entries for this
                                                        customer</td>
                                                </tr>
                                            @else
                                                @foreach ($vendorEntries as $entry)
                                                    <tr>
                                                        <td class="text-center">{{ $entry->date }}</td>
                                                        <td class="text-center">{{ $entry->due_date }}</td>
                                                        <td class="text-center">{{ $entry->bill_no }}</td>
                                                        <td class="text-red text-right">₹{{ $entry->amount_due ?? '-' }}
                                                        </td>
                                                        <td class="text-green text-right">₹{{ $entry->amount_paid ?? '-' }}
                                                        </td>
                                                        <td class="text-center">{{ $entry->type }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">Due Amount: <span
                                                    class="text-red">₹{{ $totalDue }}</span>
                                            </th>
                                            <th class="text-right">Paid Amount: <span
                                                    class="text-green">₹{{ $totalPaid }}</span>
                                            </th>
                                            <th class="text-right">Total Due Amount: <span
                                                    class="text-info">₹{{ $totalDues }}</span> </th>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('script')
    <script>
        document.getElementById('print-pdf').addEventListener('click', function() {
            window.print();
        });
    </script>
@endsection
