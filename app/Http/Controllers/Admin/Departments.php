<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Upload;

class Departments extends Controller
{
    public function index()
    {
        return view('admin.departments.index');
    }
    public function create()
    {
        return view('admin.departments.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'icon' => 'image|mimes:jpg,jpeg,png,gif'
        ]);

        $department = new Department();

        $department->dep_name_ar = $request->dep_name_ar;
        $department->dep_name_en = $request->dep_name_en;
        $department->description = $request->description;
        $department->keywords = $request->keywords;
        $department->parent_id = $request->parent;
        $department->icon = Upload::upload([
            'file' => 'icon',
            'path' => 'departments',
            'upload_type' => 'single',
            'delete_file' => ''
        ]);


        $department->save();
        session()->flash('success', trans('admin.department_added_successfully'));

        return redirect(aurl('departments'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.departments.edit', compact('department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'dep_name_ar' => 'required',
            'dep_name_en' => 'required',
            'logo' => 'sometimes|nullable|image'
        ]);
        $department = Department::findOrFail($id);

        $department->dep_name_ar = $request->dep_name_ar;
        $department->dep_name_en = $request->dep_name_en;
        $department->description = $request->description;
        $department->keywords = $request->keywords;
        $department->parent_id = $request->parent;
        $department->icon = Upload::upload([
            'file' => 'icon',
            'path' => 'departments',
            'upload_type' => 'single',
            'delete_file' => $department->icon
        ]);

        $department->update();
        session()->flash('success', trans('admin.country_updateded_successfully'));
        return redirect(aurl('departments'));
    }
    public static function delete_all_children($id)
    {
        $departments_parents = Department::where('parent_id', $id)->get();

        foreach ($departments_parents as $subDep) {

            self::delete_all_children($subDep->id);

            if (!empty($subDep->icon)) {
                \Storage::has($subDep->icon) ? \Storage::delete($subDep->icon) : '';
            }
            $subDep->delete();
        }
        $mainDep = Department::findOrFail($id);
        if (!empty($mainDep->icon)) {
            \Storage::has($mainDep->icon) ? \Storage::delete($mainDep->icon) : '';
        }
        $mainDep->delete();
    }
    public function destroy($id)
    {
        self::delete_all_children($id);
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function multi_delete()
    {
        $items = request('item');
        $countries = Department::findOrFail($items);
        $countries->each(function ($country) {
            \Storage::delete($country->logo);
            $country->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
}
