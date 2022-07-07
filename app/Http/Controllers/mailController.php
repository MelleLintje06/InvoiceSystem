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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class mailController extends Controller
{
    public function index(Request $request) {
        // Get data
        $invoice = Invoice::findOrFail($request->id);
        $customer = Customer::findOrFail($invoice->customer_id);
        $person = Contact_person::where('company_id', $invoice->customer_id)->get()->first();

        // PDF
        $invoices = Invoice::findOrFail($request->id);
        $products = Product::get();
        $details = Invoice_detail::where('invoice_id', $request->id)->get();

        // Set PDF
        $pdf = PDF::loadView('invoices.pdf', compact('invoices', 'details', 'customer', 'products'));
        Storage::put('public/invoices/invoice_'.$invoice->id . '.pdf', $pdf->output());

        // // Pakt de PDF file
        $id = $invoice->id;
        $files = ["storage/invoices/invoice_$invoice->id.pdf"];
        $data = array('gender'=>$person->gender, 'firstname'=>$person->firstname, 'name'=>$customer->name, 'id'=>$invoice->id);
        $email = $customer->email;

        // Versturen mail
        Mail::send('emails/invoice', $data, function($message) use ($email, $files, $id) {
            $message->to($email, $email)->subject("Factuur $id | InspireWeb");
            $message->from('mail@inspireweb.nl','no-reply');
            $message->bcc('webmaster@inspireweb.nl', 'InspireWeb');
            foreach ($files as $file){
                $message->attach($file);
            }
        });

        foreach ($files as $file){
            File::delete($file);
        }

        return redirect()->route('invoices');
    }
}
