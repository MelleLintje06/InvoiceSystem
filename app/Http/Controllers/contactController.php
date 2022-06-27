<?php

namespace App\Http\Controllers;

use App\Models\Contact_person;
use App\Models\Customer;

use Illuminate\Http\Request;

class contactController extends Controller
{
    public function index() {
        $contacts = Contact_person::get();
        $companies = Customer::get();
        return view('contacts.contacts', compact('contacts', 'companies'));
    }

    public function create() {
        $companies = Customer::get();
        return view('contacts.create', compact('companies'));
    }

    public function post(Request $request) {
        $contact = new Contact_person;
        $contact->gender = $request->input('gender');
        $contact->firstname = $request->input('f-name');
        $contact->lastname = $request->input('l-name');
        $contact->company_id = $request->input('company');
        $contact->save();

        return redirect()->route('contacts');
    }
}
