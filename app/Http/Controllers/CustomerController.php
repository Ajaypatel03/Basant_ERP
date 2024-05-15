<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('add_customer',compact('customers'));
    }

   
    public function create()
    {
        //
    }

   
    public function store(CustomerRequest $request)
    {
        Customer::create([
             'name'=>$request->input('name'),
             'mobile'=>$request->input('mobile'),
             'address'=>$request->input('address'),
        ]);
        
        return redirect()->route('customer.index')->with('alert-success','Customer Created Successfully!');
        // return redirect()->with('alert-success','Customer Created Successfully!');
    }


    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('edit_customer', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->name = $request->input('name');
        $customer->mobile = $request->input('mobile');
        $customer->address = $request->input('address');
        $customer->save();

        return redirect()->route('customer.index')->with('alert-success', 'Customer updated successfully');
    }   
   
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('alert-success', 'Customer deleted successfully');
    }
    
}