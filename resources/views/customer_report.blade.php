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
                        <h3 class="box-title">Customer Report</h3>
                        <a id="print-pdf"class="btn btn-warning pull-right print-hidden">Generate PDF</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('customerReport.index') }}" method="POST" class="print-hidden">
                                        @csrf
                                        <div class="form-group col-md-12" style="display: flex;margin-bottom:10px;">
                                            <label for="customer_id">Select Customer:</label>
                                            <select name="customer_id" id="customer_id" class="form-control">
                                                <option value="" selected disabled>Select</option>
                                                @foreach ($customers as $cust)
                                                    <option value="{{ $cust->id }}">
                                                        {{ $cust->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit"
                                                class="btn btn-primary"style="margin-left:10px;">Filter</button>
                                        </div>
                                    </form>
                                    @if ($selectedCustomer)
                                        <div class="text-center"@style('margin-bottom:10px;')>Selected Customer:
                                            {{ $selectedCustomer->name }}</div>
                                    @endif

                                    <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Date</th>
                                                <th>Items</th>
                                                <th>Amount Due</th>
                                                <th>Amount Paid</th>
                                                <th>Payment Type</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($customerEntries->isEmpty())
                                                <tr>
                                                    <td colspan="4" class="text-center text-danger">No entries for this
                                                        customer</td>
                                                </tr>
                                            @else
                                                @foreach ($customerEntries as $entry)
                                                    <tr>
                                                        <td class="text-center">{{ $entry->date }}</td>
                                                        <td class="text-center">{{ $entry->items }}</td>
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
