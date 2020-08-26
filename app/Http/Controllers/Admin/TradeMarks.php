<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TradeMark;
use App\DataTables\TradeMarksDataTable;
use Upload;

class TradeMarks extends Controller
{
    public function index(TradeMarksDataTable $datatable)
    {
        return $datatable->render('admin.trademarks.index');
    }
    public function create()
    {
        return view('admin.trademarks.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $trademark = new TradeMark();

        $trademark->name_ar = $request->name_ar;
        $trademark->name_en = $request->name_en;
        $trademark->logo = Upload::upload([
            'file' => 'logo',
            'path' => 'trademarks',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);
        $trademark->save();
        session()->flash('success', trans('admin.country_added_successfully'));

        return redirect(aurl('trademarks'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $trademark = TradeMark::findOrFail($id);
        return view('admin.trademarks.edit', compact('trademark'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'sometimes|nullable',
            'name_en' => 'sometimes|nullable',
            'logo' => 'sometimes|nullable|image'
        ]);
        $trademark = TradeMark::findOrFail($id);

        $trademark->name_ar = $request->name_ar;
        $trademark->name_en = $request->name_en;
        if (request()->has('logo')) {
            $trademark->logo = Upload::upload([
                'file'        => 'logo',
                'path'        => 'trademarks',
                'upload_type' => 'single',
                'delete_file' => TradeMark::find($id)->logo,
            ]);
        }

        $trademark->update();
        session()->flash('success', trans('admin.trademark_updateded_successfully'));
        return redirect(aurl('trademarks'));
    }
    public function destroy($id)
    {
        $trademark = TradeMark::findOrFail($id);
        \Storage::delete($trademark->logo);
        $trademark->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $trademarks = TradeMark::findOrFail($items);
        $trademarks->each(function ($trademark) {
            \Storage::delete($trademark->logo);
            $trademark->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
