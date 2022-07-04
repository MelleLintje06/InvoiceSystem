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

    public function post(Request $request) {
        // Factuur
        $invoice = new Invoice;
        $invoice->customer_id = $request['customers'];
        $invoice->person_id = $request['contacts'];
        $invoice->text = $request['description'];
        $invoice->paid = 0;
        $invoice->created_at = $request['datetime'];
        $invoice->updated_at = $request['expiredate'];
        $invoice->save();
        // Factuur details
        $i = 0;
        foreach ($request['product'] as $product) {
            $i_d = new Invoice_detail;
            $i_d->invoice_id = $invoice->id;
            $i_d->product_id = $product;
            $i_d->quantity = $request['amount'][$i];
            $i_d->discount = $request['sale'][$i];
            $i_d->save();
            $i = $i +1;
        }

        return redirect()->route('invoices');
    }

    public function post_xml(Request $request) {
        // Leest XML file
        if ($request->xml !== null) {
            $json = json_encode(simplexml_load_string(file_get_contents($request->xml)));
            $phpArray = json_decode($json, true);

            foreach ($phpArray as $item) {
                $invoice = new Invoice;
                $invoice->customer_id = $item['CompanyID'];
                $invoice->person_id = $item['ContactID'];
                $invoice->text = $item['Text'];
                $invoice->paid = 0;
                $invoice->created_at = $item['CreatedAt'];
                $invoice->updated_at = $item['UpdatedAt'];
                $invoice->save();

                foreach ($item['Details']['Detail'] as $item_detail) {
                    $detail = new Invoice_detail;
                    $detail->invoice_id = $invoice->id;
                    $detail->product_id = $item_detail['ProductID'];
                    $detail->quantity = $item_detail['Quantity'];
                    $detail->discount = $item_detail['Discount'];
                    $detail->save();
                }
            }
        }
        return redirect()->route('invoices');
    }

    public function finish($id) {
        $factuur = Invoice::findOrFail($id);
        $factuur->paid = 1;
        $factuur->update();
        return redirect()->route('invoices');
    }

    public function destroy(Request $request) {
        // First delete details before invoice to avoid errors
        Invoice_detail::where('invoice_id', $request->id)->delete();
        Invoice::where('id', $request->id)->first()->delete();
        return redirect()->route('invoices');
    }
}
