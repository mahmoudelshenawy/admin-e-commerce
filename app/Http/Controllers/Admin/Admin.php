<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin as AdminModel;
use App\Mail\AdminResetPassword;
use Carbon\Carbon;
use DB;
use Mail;
use App\DataTables\AdminsDataTable;

class Admin extends Controller
{
    public function index(AdminsDataTable $datatable)
    {
        return $datatable->render('admin.index');
    }
    public function create()
    {
        return view('admin.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:7|confirmed',
            'password_confirmation' => 'required',
        ]);
        $admin = new AdminModel();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);

        $admin->save();
        session()->flash('success', trans('admin.admin_added_successfully'));
        // return redirect(aurl('admins'));
        return redirect(aurl('admins'));
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $admin = AdminModel::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'sometimes|nullable|min:7|confirmed',
            'password_confirmation' => 'required'
        ]);
        $admin = AdminModel::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        if (request()->has('password')) {
            $admin->password = bcrypt($request->password);
        }
        $admin->update();
        session()->flash('success', trans('admin.admin_updateded_successfully'));
        return redirect(aurl('admins'));
    }
    public function destroy($id)
    {
        $admin = AdminModel::findOrFail($id);
        $admin->delete();
        session()->flash('success', trans('admin.removed_successfully'));

        return back();
    }
    public function deleteAll()
    {
        dd('try this');
    }
    public function multi_delete()
    {
        $items = request('item');
        $admins = AdminModel::findOrFail($items);
        $admins->each(function ($admin) {
            $admin->delete();
        });
        session()->flash('success', trans('admin.removed_successfully'));
        return back();
    }
    public function login()
    {
        // if (admin()) {
        //     return redirect('admin');
        // } else {
        return view('admin.Auth.login');
        // }
    }
    public function finishLogin(Request $request, AdminModel $admin)
    {
        $rememberMe = $request->rememberme == 1 ? true : false;
        if (admin()->attempt(['email' => $request->email, 'password' => $request->password], $rememberMe)) {

            return redirect(aurl('admins'));
            // return back();
        } else {
            session()->flash('error', trans('admin.inccorrect_information_login'));
            return redirect('admin/login');
        }
    }

    public function logout()
    {
        admin()->logout();
        return redirect('admin/login');
    }

    public function forgotPassword()
    {
        return view('admin.Auth.forget_password');
    }

    public function getTokenToReset()
    {
        $admin = AdminModel::where('email', request('email'))->first();
        if (!empty($admin)) {
            $token = app('auth.password.broker')->createToken($admin);
            $data = DB::table('password_resets')->insert([
                'email' => $admin->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::to($admin->email)->send(new AdminResetPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('auth.reset_link_sent'));
            return back();
        }
        return back();
    }

    public function getResetPassword($token)
    {
        $checked_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if (!empty($checked_token)) {
            return view('admin.Auth.reset_password', ['data' => $checked_token]);
        } else {
            return redirect(aurl('forgot/password'));
        }
    }

    public function postResetPassword($token)
    {
        $this->validate(request(), [
            'password' => 'required|min:7|confirmed',
            'password_confirmation' => 'required'
        ], [], [
            // 'password.required' => trans('auth.password_required'),
            // 'password.confirmed' => trans('auth.password_not_confirmed'),
            // 'password.min' => trans('password.min')
            'password' => 'password',
            'password_confirmation' => 'password confirmation'
        ]);


        $checked_token = DB::table('password_resets')->where('token', $token)->where('created_at', '>', Carbon::now()->subHour(2))->first();
        if (!empty($checked_token)) {
            $admin = AdminModel::where('email', $checked_token->email)->update(['email', $checked_token->email, 'password' => bcrypt(request('password'))]);

            DB::table('password_resets')->where('email', request('email'))->delete();
            admin()->attempt(['email' => request('email'), 'password' => request('password')], true);
            return redirect(aurl(''));
        } else {
            return redirect(aurl('forgot/password'));
        }
    }
}
