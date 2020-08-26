<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\DataTables\ManufacturerDataTable;
use Upload;

class Manufacturers extends Controller
{
    public function index(ManufacturerDataTable $datatable)
    {
        return $datatable->render('admin.manufacturers.index');
    }
    public function create()
    {
        return view('admin.manufacturers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'website' => 'sometimes|nullable|url',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'mobile' => 'sometimes|nullable|numeric',
            'logo' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $manufacturer = new Manufacturer();

        $manufacturer->name_ar = $request->name_ar;
        $manufacturer->name_en = $request->name_en;
        $manufacturer->website = $request->website;
        $manufacturer->mobile = $request->mobile;
        $manufacturer->facebook = $request->facebook;
        $manufacturer->twitter = $request->twitter;
        $manufacturer->address = $request->address;
        $manufacturer->lat = $request->lat;
        $manufacturer->lng = $request->lng;
        $manufacturer->contact_manager = $request->contact_manager;
        $manufacturer->email = $request->email;
        $manufacturer->logo = Upload::upload([
            'file' => 'logo',
            'path' => 'manufacturers',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);
        $manufacturer->save();
        session()->flash('success', trans('admin.manufacturer_added_successfully'));

        return redirect(aurl('manufacturers'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $manufact = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.edit', compact('manufact'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'website' => 'sometimes|nullable|url',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'mobile' => 'sometimes|nullable|numeric',
            'logo' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $manufacturer = Manufacturer::findOrFail($id);

        $manufacturer->name_ar = $request->name_ar;
        $manufacturer->name_en = $request->name_en;
        $manufacturer->website = $request->website;
        $manufacturer->mobile = $request->mobile;
        $manufacturer->facebook = $request->facebook;
        $manufacturer->twitter = $request->twitter;
        $manufacturer->address = $request->address;
        $manufacturer->lat = $request->lat;
        $manufacturer->lng = $request->lng;
        $manufacturer->contact_manager = $request->contact_manager;
        $manufacturer->email = $request->email;
        if (request()->has('logo')) {
            $manufacturer->logo = Upload::upload([
                'file'        => 'logo',
                'path'        => 'manufacturers',
                'upload_type' => 'single',
                'delete_file' => Manufacturer::find($id)->logo,
            ]);
        }

        $manufacturer->update();
        session()->flash('success', trans('admin.manu$manufacturer_updateded_successfully'));
        return redirect(aurl('manufacturers'));
    }
    public function destroy($id)
    {
        $manufacturer = Manufacturer::findOrFail($id);
        \Storage::delete($manufacturer->logo);
        $manufacturer->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $manufacturers = Manufacturer::findOrFail($items);
        $manufacturers->each(function ($manufacturer) {
            \Storage::delete($manufacturer->logo);
            $manufacturer->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
