<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    
    public function index()
    {
        $vendors = Vendor::paginate(10);
        return view('add_vendor',compact('vendors'));
    }

    
    public function create()
    {
        //
    }

    public function store(VendorRequest $request)
    {
        Vendor::create([
            'v_name'=>$request->input('v_name'),
            'v_mobile'=>$request->input('v_mobile'),
            'v_address'=>$request->input('v_address'),
            'v_bank_name'=>$request->input('v_bank_name'),
            'v_bank_acc_no'=>$request->input('v_bank_acc_no'),
            'v_ifsc'=>$request->input('v_ifsc'),
            'v_bank_location'=>$request->input('v_bank_location'),
        ]);

        return redirect()->route('vendor.index')->with('alert-success','Vendor Added Successfully!');
        // return redirect()->with('alert-success','Customer Created Successfully!');
    }
    

    public function show(string $id)
    {
        //
    }

    
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        return view('edit_vendor', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->v_name =$request->input('v_name');
        $vendor->v_mobile =$request->input('v_mobile');
        $vendor->v_address =$request->input('v_address');
        $vendor->v_bank_name =$request->input('v_bank_name');
        $vendor->v_bank_acc_no =$request->input('v_bank_acc_no');
        $vendor->v_ifsc =$request->input('v_ifsc');
        $vendor->v_bank_location =$request->input('v_bank_location');
        $vendor->save();

        return redirect()->route('vendor.index')->with('alert-success', 'Vendor updated successfully');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();

        return redirect()->route('vendor.index')->with('alert-success', 'Vendor deleted successfully');
    }
}