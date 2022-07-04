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

    public function details(Request $request) {
        $contact = Contact_person::findOrFail($request->id);
        $company = Customer::findOrFail($contact->company_id);
        return view('contacts.details', compact('contact', 'company'));
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
        $contact->role = $request->input('role');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->save();

        return redirect()->route('contacts');
    }

    public function edit(Request $request) {
        $contact = Contact_person::findOrFail($request->id);
        $companies = Customer::get();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    public function update(Request $request) {
        $contact = Contact_person::findOrFail($request->input('id'));
        $contact->gender = $request->input('gender');
        $contact->firstname = $request->input('f-name');
        $contact->lastname = $request->input('l-name');
        $contact->company_id = $request->input('company');
        $contact->role = $request->input('role');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->update();

        return redirect()->route('contacts');
    }
}
