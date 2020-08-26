<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\DataTables\CountriesDataTable;
use Upload;

class Countries extends Controller
{
    public function index(CountriesDataTable $datatable)
    {
        return $datatable->render('admin.countries.index');
    }
    public function create()
    {
        return view('admin.countries.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob' => 'required',
            'code'  => 'required',
            'currency' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $country = new Country();

        $country->country_name_ar = $request->country_name_ar;
        $country->country_name_en = $request->country_name_en;
        $country->mob = $request->mob;
        $country->code = $request->code;
        $country->currency = $request->currency;
        $country->logo = Upload::upload([
            'file' => 'logo',
            'path' => 'countries',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);


        $country->save();
        session()->flash('success', trans('admin.country_added_successfully'));

        return redirect(aurl('countries'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin.countries.edit', compact('country'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'country_name_ar' => 'required',
            'country_name_en' => 'required',
            'mob' => 'required',
            'code'  => 'required',
            'logo' => 'sometimes|nullable|image'
        ]);
        $country = Country::findOrFail($id);

        $country->country_name_ar = $request->country_name_ar;
        $country->country_name_en = $request->country_name_en;
        $country->mob = $request->mob;
        $country->code = $request->code;
        $country->currency = $request->currency;
        if (request()->has('logo')) {
            $country->logo = $request->logo;
        }

        $country->update();
        session()->flash('success', trans('admin.country_updateded_successfully'));
        return redirect(aurl('countries'));
    }
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        \Storage::delete($country->logo);

        $country->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $countries = Country::findOrFail($items);
        $countries->each(function ($country) {
            \Storage::delete($country->logo);
            $country->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
