<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorEntry;
use Illuminate\Http\Request;

class VendorEntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendorEntries = VendorEntry::paginate(10);
        $vendors = Vendor::all();
        $totalAmountDue = $vendorEntries->sum('amount_due');
        $totalAmountPaid = $vendorEntries->sum('amount_paid');
        return view('vendorEntries',compact('vendors','vendorEntries','totalAmountDue','totalAmountPaid'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        VendorEntry::create([
            'date'=>$request->input('date'),
            'due_date'=>$request->input('due_date'),
            'vendor_id'=>$request->input('vendor_id'),
            'bill_no'=>$request->input('bill_no'),
            'amount_due'=>$request->input('amount_due'),
            'amount_paid'=>$request->input('amount_paid'),
            'type'=>$request->input('type'),
        ]);

        return redirect()->route('vendorEntries.index')->with('alert-success','Vendor Entry Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendors = Vendor::all();
        $vendorEntries = VendorEntry::findOrFail($id);
        return view('edit_vendorEntries', compact('vendorEntries','vendors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vendorEntry = VendorEntry::findOrFail($id);

        $vendorEntry->update([
            'date' => $request->input('date'),
            'due_date' => $request->input('due_date'),
            'vendor_id' => $request->input('vendor_id'),
            'bill_no' => $request->input('bill_no'),
            'amount_due' => $request->input('amount_due'),
            'amount_paid' => $request->input('amount_paid'),
            'type'=>$request->input('type'),
        ]);

        return redirect()->route('vendorEntries.index')->with('alert-success', 'Vendor Entry Updated
        Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $vendorEntry = VendorEntry::findOrFail($id);
         $vendorEntry->delete();

         return redirect()->route('vendorEntries.index')->with('alert-success', 'Vendor Entries deleted
         successfully');
    }

    public function vendorReportIndex(Request $request)
    {
        // Get the selected customer ID from the request
        $vendorId = $request->input('vendor_id');

        // Fetch the vendor and their transactions
        $vendors = Vendor::all();
        $vendorEntries = VendorEntry::where('vendor_id', $vendorId)->get();

        // Fetch the selected vendor
        $selectedVendor = Vendor::find($request->input('vendor_id'));

        // Calculate total due and paid amounts for the vendor
        $totalDue = $vendorEntries->sum('amount_due');
        $totalPaid = $vendorEntries->sum('amount_paid');
        $totalDues = $totalDue - $totalPaid;

        return view('vendor_report', compact('vendors', 'vendorEntries','totalDue','totalPaid',
        'totalDues','selectedVendor'));
    }
}