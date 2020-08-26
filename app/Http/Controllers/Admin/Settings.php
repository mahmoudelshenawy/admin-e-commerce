<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Upload;

class Settings extends Controller
{
    public function showSettings()
    {
        return view('admin.site-settings.index');
    }

    public function saveSettings()
    {
        $this->validate(request(), [
            'logo' => 'image|mimes:jpg,jpeg,png,gif',
            'icon' => 'image|mimes:jpg,jpeg,png,gif'
        ]);
        $data = request()->except(['_token', '_method']);
        if (request()->hasFile('logo')) {
            $data['logo'] = Upload::upload([
                'file' => 'logo',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->logo
            ]);
        }
        if (request()->hasFile('icon')) {

            $data['icon'] = Upload::upload([
                'file' => 'icon',
                'path' => 'settings',
                'upload_type' => 'single',
                'delete_file' => setting()->icon
            ]);
        }

        Setting::orderBy('id', 'desc')->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('settings'));
    }
}
