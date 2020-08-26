<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\User;
use App\DataTables\ShippingsDataTable;
use Upload;

class Shippings extends Controller
{
    public function index(ShippingsDataTable $datatable)
    {
        return $datatable->render('admin.shippings.index');
    }
    public function create()
    {
        $companies = User::where('level', 'company')->get(['name', 'id']);
        return view('admin.shippings.create', compact('companies'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'user_id' => 'required|numeric',
            'lat'     => 'sometimes|nullable',
            'lng'     => 'sometimes|nullable',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif'
        ]);
        $shipping = new Shipping();

        $shipping->name_ar = $request->name_ar;
        $shipping->name_en = $request->name_en;
        $shipping->user_id = $request->user_id;
        $shipping->lat = $request->lat;
        $shipping->lng = $request->lng;
        $shipping->icon = Upload::upload([
            'file' => 'icon',
            'path' => 'shippings',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);


        $shipping->save();
        session()->flash('success', trans('admin.shipping_added_successfully'));

        return redirect(aurl('shippings'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $shipping = Shipping::findOrFail($id);
        $companies = User::where('level', 'company')->get(['name', 'id']);
        return view('admin.shippings.edit', compact('shipping', 'companies'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'user_id' => 'required|numeric',
            'lat'     => 'sometimes|nullable',
            'lng'     => 'sometimes|nullable',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif'
        ]);
        $shipping = Shipping::findOrFail($id);

        $shipping->name_ar = $request->name_ar;
        $shipping->name_en = $request->name_en;
        $shipping->user_id = $request->user_id;
        $shipping->lat = $request->lat;
        $shipping->lng = $request->lng;
        $shipping->icon = Upload::upload([
            'file' => 'icon',
            'path' => 'shippings',
            'upload_type' => 'single',
            'delete_file' => $shipping->icon
        ]);


        $shipping->update();
        session()->flash('success', trans('admin.shipping_updated_successfully'));

        return redirect(aurl('shippings'));
    }
    public function destroy($id)
    {
        $shipping = Shipping::findOrFail($id);
        \Storage::delete($shipping->icon);

        $shipping->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $shippings = Shipping::findOrFail($items);
        $shippings->each(function ($shipping) {
            \Storage::delete($shipping->icon);
            $shipping->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
