<?php

namespace App\Http\Controllers;

// Models
use App\Models\Customer;

// Illuminate
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function index() {
        $customers = Customer::get();
        return view('customers', compact('customers'));
    }

    public function details($slug) {
        $customer = Customer::where('slug', $slug)->first(); //like?
        return $customer;
    }
}
