<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $customerCount = Customer::count();
        $vendorCount = Vendor::count();
        return view('dashboard',compact('customerCount','vendorCount'));
    }
}