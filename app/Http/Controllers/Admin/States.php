<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\State;
use App\DataTables\StatesDataTable;
use App\Models\Country;

class States extends Controller
{
    public function index(StatesDataTable $datatable)
    {
        // $cities = $model->newQuery()->with('country')->get();
        // $q =   City::query()->with('country')->get();

        // dd($q);
        return $datatable->render('admin.states.index');
    }
    public function create()
    {
        if (request()->ajax()) {

            if (request()->has('country_id')) {

                $select = request()->has('select') ? request('select') : '';
                $cities =  City::where('country_id', '=', request('country_id'))->get();

                return $cities;
            }
        }
        $countries = Country::all([
            'country_name_ar',
            'country_name_en',
            'id'
        ]);
        return view('admin.states.create', compact('countries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric'
        ]);
        $state = new State();

        $state->state_name_ar = $request->state_name_ar;
        $state->state_name_en = $request->state_name_en;
        $state->country_id = $request->country_id;
        $state->city_id = $request->city_id;
        $state->save();
        session()->flash('success', trans('admin.state_added_successfully'));

        return redirect(aurl('states'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $state = State::findOrFail($id);
        $countries = Country::all([
            'country_name_ar',
            'country_name_en',
            'id'
        ]);
        $cities = City::all([
            'city_name_ar',
            'city_name_en',
            'id'
        ]);
        return view('admin.states.edit')->with([
            'countries' => $countries,
            'cities' => $cities,
            'state' => $state
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'state_name_ar' => 'required',
            'state_name_en' => 'required',
            'country_id' => 'required',
            'city_id' => 'required|numeric'
        ]);
        $state = State::findOrFail($id);

        $state->state_name_ar = $request->state_name_ar;
        $state->state_name_en = $request->state_name_en;
        $state->country_id = $request->country_id;
        $state->city_id = $request->city_id;
        $state->update();
        session()->flash('success', trans('admin.state_updated_successfully'));

        return redirect(aurl('states'));
    }
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $states = State::findOrFail($items);
        $states->each(function ($state) {
            $state->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
