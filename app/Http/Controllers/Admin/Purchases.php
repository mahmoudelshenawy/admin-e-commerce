<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PurchaseDataTable;
use App\Models\Purchase;
use Upload;

class Purchases extends Controller
{
    public function index(PurchaseDataTable $datatable)
    {
        return $datatable->render('admin.purchases.index');
    }
    public function create()
    {
        return view('admin.purchases.create');
    }
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'admin_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'numeric',
            'status' => 'required|in:ordered,pending,received',
            'purchase_price' => 'required',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'coupon' => 'nullable',
            'total_price' => 'required|numeric',
            'payment_type' => 'required|in:cash,visa,mastercard',
            'payment_status' => 'in:paid,due',
            'payment_price' => 'numeric|nullable',
            'submit_time' => 'date',
            'delivery_time' => 'date',
        ], [], [
            'admin_id' => 'admin',
            'user_id' => 'customer',
            'product_id' => 'product',
        ]);

        Purchase::create($data);

        session()->flash('success', trans('admin.mall_added_successfully'));

        return redirect(aurl('purchases'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('admin.purchases.edit', compact('purchase'));
    }
    public function update(Request $request, $id)
    {
        $data = $this->validate($request, [
            'admin_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'quantity' => 'numeric',
            'status' => 'required|in:ordered,pending,received',
            'purchase_price' => 'required',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'coupon' => 'nullable',
            'total_price' => 'required|numeric',
            'payment_type' => 'required|in:cash,visa,mastercard',
            'payment_status' => 'in:paid,due',
            'payment_price' => 'numeric|nullable',
            'submit_time' => 'date',
            'delivery_time' => 'date',
        ], [], [
            'admin_id' => 'admin',
            'user_id' => 'customer',
            'product_id' => 'product',
        ]);

        Purchase::where('id', $id)->update($data);

        session()->flash('success_update', trans('admin.purchase_edited_successfully'));

        return redirect(aurl('purchases'));
    }

    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $purchase->delete();

        session()->flash('success_delete', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $purchases = Purchase::findOrFail($items);
        $purchases->each(function ($purchase) {
            $purchase->delete();
        });
        session()->flash('success_delete', trans('admin.removed_successfully'));
        return back();
    }
}
