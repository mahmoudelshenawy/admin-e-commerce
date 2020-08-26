<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\DataTables\UsersDataTable;

class Users extends Controller
{
    public function index(UsersDataTable $datatable)
    {
        return $datatable->render('admin.users.index');
    }
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:7|confirmed',
            'password_confirmation' => 'required',
            'level' => 'required|in:customer,vendor,company'
        ]);
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->password = bcrypt($request->password);

        $user->save();
        session()->flash('success', trans('admin.user_added_successfully'));
        return redirect(aurl('users'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|min:7|confirmed',
            'password_confirmation' => 'required'
        ]);
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        if (request()->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update();
        session()->flash('success', trans('admin.user_updateded_successfully'));
        return redirect(aurl('users'));
    }
    public function destroy($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
}
