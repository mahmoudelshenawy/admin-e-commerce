<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\DataTables\CitiesDataTable;
use App\Models\Country;

class Cities extends Controller
{
    public function index(CitiesDataTable $datatable)
    {
        // $cities = $model->newQuery()->with('country')->get();
        // $q =   City::query()->with('country')->get();

        // dd($q);
        return $datatable->render('admin.cities.index');
    }
    public function create()
    {
        $countries = Country::all([
            'country_name_ar',
            'id'
        ]);
        return view('admin.cities.create', compact('countries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'city_name_ar' => 'required',
            'city_name_en' => 'required',
            'country_id' => 'required|numeric'
        ]);
        $city = new City();

        $city->city_name_ar = $request->city_name_ar;
        $city->city_name_en = $request->city_name_en;
        $city->country_id = $request->country_id;

        $city->save();
        session()->flash('success', trans('admin.city_added_successfully'));

        return redirect(aurl('cities'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $city = city::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'city_name_ar' => 'required',
            'city_name_en' => 'required',
            'country_id' => 'required'
        ]);
        $city = City::findOrFail($id);

        $city->city_name_ar = $request->city_name_ar;
        $city->city_name_en = $request->city_name_en;
        $city->country_id = $request->country_id;

        $city->update();
        session()->flash('success', trans('admin.city_updated_successfully'));

        return redirect(aurl('cities'));
    }
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $countries = City::findOrFail($items);
        $countries->each(function ($city) {
            $city->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
