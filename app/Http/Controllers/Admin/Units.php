<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\DataTables\UnitsDataTable;
use App\Models\Unit;

class Units extends Controller
{
    public function index(UnitsDataTable $datatable)
    {
        return $datatable->render('admin.units.index');
    }
    public function create()
    {
        return view('admin.units.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'short_name' => 'required',
            'allow_decimal' => 'nullable|in:0,1'
        ]);
        $unit = new Unit();

        $unit->name_ar = $request->name_ar;
        $unit->name_en = $request->name_en;
        $unit->short_name = $request->short_name;
        $unit->allow_decimal = $request->allow_decimal;

        $unit->save();
        session()->flash('success', trans('admin.unit_added_successfully'));

        return redirect(aurl('units'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'short_name' => 'required',
            'allow_decimal' => 'nullable|in:0,1'
        ]);
        $unit = Unit::findOrFail($id);

        $unit->name_ar = $request->name_ar;
        $unit->name_en = $request->name_en;
        $unit->short_name = $request->short_name;
        $unit->allow_decimal = $request->allow_decimal;

        $unit->update();
        session()->flash('success', trans('admin.city_updated_successfully'));

        return redirect(aurl('units'));
    }
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $units = Unit::findOrFail($items);
        $units->each(function ($unit) {
            $unit->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
