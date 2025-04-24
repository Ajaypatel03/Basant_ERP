@extends('header')
@section('content')
    <style>
        /* CSS Styles */
        .image-popup {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 10%;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            overflow: auto;
        }

        .popup-content {
            margin: auto;
            display: block;
            max-width: 80%;
            max-height: 80%;
        }

        .close-popup {
            color: white;
            position: absolute;
            top: 10px;
            right: 25px;
            font-size: 35px;
            cursor: pointer;
        }
    </style>
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

                    <!-- Add Customer Entries Modal -->
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Customer Entries</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('customerEntries.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="date">Date</label>
                                                <input type="date" id="date" class="form-control" name="date"
                                                    required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="customer_id">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control" required>
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
                        </div>
                    </div>

                    <div class="box-body">
                        <!-- Image Preview Modal -->
                        <div class="image-popup">
                            <span class="close-popup">&times;</span>
                            <img class="popup-content" src="{{ asset('path/to/your/image.jpg') }}" alt="Image">
                        </div>
                        <!-- End Image Preview Modal -->
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
                                                <th>Bill Image</th>
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
                                                        Added Yet</td>
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
                                                        <td class="text-center" style="width:10%;">
                                                            <img src="{{ asset($customerEntry->image ? 'images/' . $customerEntry->image : 'images/download.png') }}"
                                                                alt="Customer Image" style="width:100%;cursor: pointer;"
                                                                class="popup-image">
                                                        </td>
                                                        <td class="text-red text-right">₹{{ $customerEntry->amount_due }}
                                                        </td>
                                                        <td class="text-green text-right">
                                                            ₹{{ $customerEntry->amount_paid ?? '-' }}</td>
                                                        <td class="text-center">{{ $customerEntry->type }}</td>
                                                        <td
                                                            style="display:flex; justify-content:center;align-items:center">
                                                            <a href="{{ route('customerEntries.edit', $customerEntry->id) }}"
                                                                class="text-info">
                                                                <span class="fa fa-pencil text-center"></span>
                                                            </a>
                                                            <form method="POST"
                                                                action="{{ route('customerEntries.destroy', $customerEntry->id) }}"
                                                                class="inner">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-link"><span
                                                                        class="fa fa-trash text-danger"></span></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    @php $serial++ @endphp
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5"></th>
                                                <th class="text-right">Total Amount Due: <span
                                                        class="text-red">₹{{ $totalAmountDue }}</span></th>
                                                <th class="text-right">Total Amount Paid: <span
                                                        class="text-green">₹{{ $totalAmountPaid }}</span></th>
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

    <script>
        // JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.popup-image');
            const popup = document.querySelector('.image-popup');
            const closeBtn = document.querySelector('.close-popup');

            images.forEach(image => {
                image.addEventListener('click', function() {
                    const imageUrl = this.src;
                    const popupImage = popup.querySelector('.popup-content');
                    popupImage.src = imageUrl;
                    popup.style.display = 'block';
                });
            });

            closeBtn.addEventListener('click', function() {
                popup.style.display = 'none';
            });

            // Close popup when clicking outside the popup content
            window.addEventListener('click', function(event) {
                if (event.target === popup) {
                    popup.style.display = 'none';
                }
            });
        });
    </script>
@endsection
