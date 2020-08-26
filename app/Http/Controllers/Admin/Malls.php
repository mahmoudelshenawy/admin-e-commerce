<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mall;
use App\DataTables\MallsDataTable;
use Upload;
use App\Models\Country;

class Malls extends Controller
{
    public function index(MallsDataTable $datatable)
    {
        return $datatable->render('admin.malls.index');
    }
    public function create()
    {
        $countries = Country::all(['id', 'country_name_ar', 'country_name_en']);
        // dd($countries);
        return view('admin.malls.create', compact('countries'));
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
            'icon' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $mall = new Mall();

        $mall->name_ar = $request->name_ar;
        $mall->name_en = $request->name_en;
        $mall->website = $request->website;
        $mall->mobile = $request->mobile;
        $mall->facebook = $request->facebook;
        $mall->twitter = $request->twitter;
        $mall->address = $request->address;
        $mall->country_id = $request->country_id;
        $mall->lat = $request->lat;
        $mall->lng = $request->lng;
        $mall->contact_manager = $request->contact_manager;
        $mall->email = $request->email;
        $mall->icon  = Upload::upload([
            'file' => 'icon ',
            'path' => 'malls',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);
        $mall->save();
        session()->flash('success', trans('admin.mall_added_successfully'));

        return redirect(aurl('malls'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $mall = Mall::findOrFail($id);
        $countries = Country::all(['id', 'country_name_ar', 'country_name_en']);
        return view('admin.malls.edit', compact('mall', 'countries'));
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
        $mall = mall::findOrFail($id);

        $mall->name_ar = $request->name_ar;
        $mall->name_en = $request->name_en;
        $mall->website = $request->website;
        $mall->mobile = $request->mobile;
        $mall->facebook = $request->facebook;
        $mall->twitter = $request->twitter;
        $mall->address = $request->address;
        $mall->lat = $request->lat;
        $mall->lng = $request->lng;
        $mall->contact_manager = $request->contact_manager;
        $mall->email = $request->email;
        if (request()->has('icon')) {
            $mall->icon = Upload::upload([
                'file'        => 'icon',
                'path'        => 'malls',
                'upload_type' => 'single',
                'delete_file' => Mall::find($id)->icon,
            ]);
        }

        $mall->update();
        session()->flash('success', trans('admin.manu$mall_updateded_successfully'));
        return redirect(aurl('malls'));
    }
    public function destroy($id)
    {
        $mall = Mall::findOrFail($id);
        \Storage::delete($mall->icon);
        $mall->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $malls = Mall::findOrFail($items);
        $malls->each(function ($mall) {
            \Storage::delete($mall->icon);
            $mall->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
