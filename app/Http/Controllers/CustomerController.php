<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = \App\Customer::all();
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        \App\Customer::create($data);
        return redirect('/customer');
    }

    public function show(\App\Customer $customer)
    {
        // $customer = \App\Customer::findOrFail($customer);
        return view('customer.show', compact('customer'));
    }

    public function edit(\App\Customer $customer)
    {
        return view('customer.edit', compact($customer));
    }
}
