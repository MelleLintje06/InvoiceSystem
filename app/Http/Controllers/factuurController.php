<?php

namespace App\Http\Controllers;

// Models
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Contact_person;

// Packages
use PDF;
use Mail;

// Illuminate
use Illuminate\Http\Request;

class factuurController extends Controller
{
    public function index() {
        $invoices = Invoice::orderBy('id', 'DESC')->get();
        $customers = Customer::get();
        return view('invoices.invoices', compact('invoices', 'customers'));
    }

    public function pdf($status, $i_id) {
        $invoices = Invoice::findOrFail($i_id);
        $details = Invoice_detail::where('invoice_id', $i_id)->get();
        $customer = Customer::findOrFail($invoices->customer_id);
        $products = Product::get();

        $pdf = PDF::loadView('invoices.pdf', compact('invoices', 'details', 'customer', 'products'));

        if ($status == 'view') {
            return $pdf->stream("invoice_$i_id.pdf");
        } elseif ($status == 'download') {
            return $pdf->download("invoice_$i_id.pdf");
        }

    }

    public function create() {
        $customers = Customer::get();
        $contacts = Contact_person::get();
        $products = Product::get();
        return view('invoices.create', compact('customers', 'contacts', 'products'));
    }

    public function post() {

    }

    public function finish($id) {
        $factuur = Invoice::findOrFail($id);
        $factuur->paid = 1;
        $factuur->update();
        return redirect('/invoices');
    }

    public function destroy(Request $request) {
        // First delete details before invoice to avoid errors
        Invoice_detail::where('invoice_id', $request->id)->delete();
        Invoice::where('id', $request->id)->first()->delete();
        return redirect('/invoices');
    }
}
