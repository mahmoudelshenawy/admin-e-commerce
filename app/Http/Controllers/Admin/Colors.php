<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ColorsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use App\DataTables\ColorsMarksDataTable;
use Upload;

class Colors extends Controller
{
    public function index(ColorsDataTable $datatable)
    {
        return $datatable->render('admin.colors.index');
    }
    public function create()
    {
        return view('admin.colors.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'color' => 'required'
        ]);
        $color = new Color();

        $color->name_ar = $request->name_ar;
        $color->name_en = $request->name_en;
        $color->color = $request->color;
        $color->save();
        session()->flash('success', trans('admin.color_added_successfully'));

        return redirect(aurl('colors'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', compact('color'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'sometimes|nullable',
            'name_en' => 'sometimes|nullable',

        ]);
        $color = color::findOrFail($id);

        $color->name_ar = $request->name_ar;
        $color->name_en = $request->name_en;
        $color->color = $request->color;

        $color->update();
        session()->flash('success', trans('admin.color_updateded_successfully'));
        return redirect(aurl('colors'));
    }
    public function destroy($id)
    {
        $color = color::findOrFail($id);

        $color->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $colors = Color::findOrFail($items);
        $colors->each(function ($color) {

            $color->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
