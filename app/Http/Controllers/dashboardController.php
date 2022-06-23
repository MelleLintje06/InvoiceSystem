<?php

namespace App\Http\Controllers;

// Models
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Contact_person;
use App\Models\Task;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index () {
        $tasks = Task::orderBy('order_nr', 'ASC')->get();
        $customers = Customer::get();
        $products = Product::get();
        $contacts = Contact_person::get();
        $invoices = Invoice::get();
        return view('dashboard.dashboard', compact('tasks', 'customers', 'products', 'contacts', 'invoices'));
    }

    public function settings() {
        // Nog aanmaken
        return;
    }
}
