<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        CustomerEntry::create([
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'items' => $request->input('items'),
            'image' => $imageName,
            'type' => $request->input('type'),
            'amount_due' => $request->input('amount_due'),
            'amount_paid' => $request->input('amount_paid'),
        ]);

        return redirect()->route('customerEntries.index')->with('alert-success', 'Customer Entry Created Successfully!');
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

        if ($request->hasFile('image')) {
            $imagePath = public_path('images/' . $customerEntry->image);
            // Check if the image exists and delete it
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            // Storage::delete('public/' . $product->image);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $customerEntry->image = $imageName;
        }

        $customerEntry->update([
            'date' => $request->input('date'),
            'customer_id' => $request->input('customer_id'),
            'items' => $request->input('items'),
            'type'=>$request->input('type'),
            'amount_due' => $request->input('amount_due'),
            'amount_paid' => $request->input('amount_paid'),
            'image' => $customerEntry->image,
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


    // public function generatePDF(Request $request)
    // {
    //     $customers = Customer::get();
    //     $customerEntries = CustomerEntry::get();
    //     $selectedCustomer = Customer::find($request->input('customer_id'));
    //     $totalDue = $customerEntries->sum('amount_due');
    //     $totalPaid = $customerEntries->sum('amount_paid');
    //     $totalDues = $totalDue - $totalPaid;

    //     $data = [
    //     'title' => 'Welcome to ItSolutionStuff.com',
    //     'date' => date('m/d/Y'),
    //     'customers' => $customers,
    //     'customerEntries' => $customerEntries,
    //     'selectedCustomer' => $selectedCustomer,
    //     'totalDue' => $totalDue,
    //     'totalPaid' => $totalPaid,
    //     'totalDues' => $totalDues,
    //     ];

    //     $pdf = PDF::loadView('customer_report', $data);

    //     return $pdf->download('basant_erp.pdf');
    // }
}