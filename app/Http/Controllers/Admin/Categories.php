<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\DataTables\CategoriesDataTable;
use Upload;

class Categories extends Controller
{
    public function index(CategoriesDataTable $datatable)
    {
        return $datatable->render('admin.categories.index');
    }
    public function create()
    {
        $parents = Category::where('parent_id', '=', NULL)->get();

        return view('admin.categories.create', compact('parents'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'parent_id' => 'nullable'
        ]);
        $category = new Category();

        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;

        if ($request->parent_id != Null) {
            $category->parent_id = $request->parent_id;
        }

        $category->short_code = $request->short_code;

        $category->save();
        session()->flash('success', trans('admin.category_added_successfully'));

        return redirect(aurl('categories'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar' => 'required',
            'name_en' => 'required',
            'parent_id' => 'numeric'
        ]);
        $category =  Category::findOrFail($id);

        $category->name_ar = $request->name_ar;
        $category->name_en = $request->name_en;
        $category->parent_id = $request->parent_id;

        $category->update();
        session()->flash('success', trans('admin.category_updated_successfully'));

        return redirect(aurl('categories'));
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);


        $category->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $categories = Category::findOrFail($items);
        $categories->each(function ($category) {
            $category->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
