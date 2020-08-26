<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //
    public function service()
    {
        // $services = \App\Service::all();
        // $services = ['hello you bitch'];

        return view('services');
    }

    public function store()
    {

        $data = request()->validate([
            'name' => 'required'
        ]);
        \App\Service::create($data);
        //first what is usual
        // done


        return redirect()->back();
    }
}
