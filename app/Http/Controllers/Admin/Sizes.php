<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\SizesDataTable;
use App\Models\Size;

class Sizes extends Controller
{
    public function index(SizesDataTable $datatable)
    {
        return $datatable->render('admin.sizes.index');
    }
    public function create()
    {
        return view('admin.sizes.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
            'allow_decimal' => 'nullable|in:0,1',
            'unit_id' => 'required',
        ]);
        $size = new Size();
        $size->name = $request->name;
        $size->short_name = $request->short_name;
        $size->unit_id = $request->unit_id;

        $size->save();
        session()->flash('success', trans('admin.size_added_successfully'));

        return redirect(aurl('sizes'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $size = Size::findOrFail($id);
        return view('admin.sizes.edit', compact('size'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'short_name' => 'required',
        ]);
        $size = Size::findOrFail($id);


        $size->name = $request->name;
        $size->short_name = $request->short_name;
        $size->unit_id = $request->unit_id;

        $size->update();
        session()->flash('success', trans('admin.city_updated_successfully'));

        return redirect(aurl('sizes'));
    }
    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $sizes = Size::findOrFail($items);
        $sizes->each(function ($size) {
            $size->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
