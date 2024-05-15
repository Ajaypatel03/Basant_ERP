<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEntry;
use Illuminate\Http\Request;
use PDF ;


class CustomerEntriesController extends Controller
{
    public function index()
    {
        $customerEntries = CustomerEntry::paginate(10);
        // Calculate total amount_due and amount_paid
        $totalAmountDue = $customerEntries->sum('amount_due');
        $totalAmountPaid = $customerEntries->sum('amount_paid');
        $customers = Customer::all();
        return view('customer_entries',compact('customers','customerEntries','totalAmountDue','totalAmountPaid'));
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        CustomerEntry::create([
            'date'=>$request->input('date'),
            'customer_id'=>$request->input('customer_id'),
            'items'=>$request->input('items'),
            'type'=>$request->input('type'),
            'amount_due'=>$request->input('amount_due'),
            'amount_paid'=>$request->input('amount_paid'),
        ]);

        return redirect()->route('customerEntries.index')->with('alert-success','Customer Entry Created Successfully!');
    }

    
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $customers = Customer::all();
        $customerEntries = CustomerEntry::findOrFail($id);
        return view('edit_customerEntries', compact('customerEntries','customers'));
    }

   
    public function update(Request $request, string $id)
    {
        $customerEntry = CustomerEntry::findOrFail($id);

        $customerEntry->update([
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'items' => $request->input('items'),
            'type'=>$request->input('type'),
            'amount_due' => $request->input('amount_due'),
            'amount_paid' => $request->input('amount_paid'),
        ]);

        return redirect()->route('customerEntries.index')->with('alert-success', 'Customer Entry Updated Successfully!');
    }


    public function destroy($id)
    {
        $customerEntries = CustomerEntry::findOrFail($id);
        $customerEntries->delete();

        return redirect()->route('customerEntries.index')->with('alert-success', 'CustomerEntries deleted successfully');
    }
    

    public function customerReportIndex(Request $request)
    {
        // Get the selected customer ID from the request
        $customerId = $request->input('customer_id');

        // Fetch the customer and their transactions
        $customers = Customer::all();
        $customerEntries = CustomerEntry::where('customer_id', $customerId)->get();

        // Fetch the selected customer
        $selectedCustomer = Customer::find($request->input('customer_id'));

        // Calculate total due and paid amounts for the customer
        $totalDue = $customerEntries->sum('amount_due');
        $totalPaid = $customerEntries->sum('amount_paid');
        $totalDues = $totalDue - $totalPaid;

        return view('customer_report', compact('customers', 'customerEntries','totalDue','totalPaid',
                                        'totalDues','selectedCustomer'));
    }


}