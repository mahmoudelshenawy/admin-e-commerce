<?php
if (!function_exists('setting')) {
    function setting()
    {
        return \App\Models\Setting::orderBy('id', 'desc')->first();
    }
}
if (!function_exists('active')) {
    function active($link)
    {
        if (preg_match('/' . $link . '/i', Request::segment(2))) {
            return 'active';
        } else {
            return '';
        }
    }
}




if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/' . $url);
    }
}

if (!function_exists('load_deparment')) {
    function load_department($select = null, $dep_disabled = null)
    {
        $departments = \App\Models\Department::selectRaw('dep_name_' . session('lang') . ' as text')->selectRaw('id as id')->selectRaw('parent_id as parent')->get(['text', 'parent', 'id']);

        $dep_tree = [];

        foreach ($departments as $department) {
            $list_arr = [];

            $list_arr['icon'] = '';
            $list_arr['li_attr'] = '';
            $list_arr['a_attr'] = '';
            $list_arr['children'] = [];

            if ($select !== null and $select == $department->id) {
                $list_arr['state'] = [
                    'opened' => true,
                    'selected'  => true,
                    'disabled' => false
                ];
            }

            if ($dep_disabled !== null and $dep_disabled == $department->id) {
                $list_arr['state'] = [
                    'opened' => false,
                    'selected'  => false,
                    'disabled' => true,
                    'hidden'  => true
                ];
            }

            $list_arr['id'] = $department->id;
            $list_arr['parent'] = $department->parent > 0 ? $department->parent : '#';

            $list_arr['text'] = $department->text;
            array_push($dep_tree, $list_arr);
        }

        return json_encode($dep_tree, JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (session()->has('lang')) {
            return session('lang');
        } else {
            session()->put('lang', 'ar');
        }
    }
}

if (!function_exists('direction')) {
    function direction()
    {
        if (session()->has('lang')) {
            if (session('lang') == 'ar') {
                return 'rtl';
            } else {
                return 'ltr';
            }
        } else {
            return 'ltr';
        }
    }
}

if (!function_exists('datatable_lang')) {
    function datatable_lang()
    {
        return [
            'sProcessing' => trans('admin.sProcessing'),
            'sLengthMenu'        => trans('admin.sLengthMenu'),
            'sZeroRecords'       => trans('admin.sZeroRecords'),
            'sEmptyTable'        => trans('admin.sEmptyTable'),
            'sInfo'              => trans('admin.sInfo'),
            'sInfoEmpty'         => trans('admin.sInfoEmpty'),
            'sInfoFiltered'      => trans('admin.sInfoFiltered'),
            'sInfoPostFix'       => trans('admin.sInfoPostFix'),
            'sSearch'            => trans('admin.sSearch'),
            'sUrl'               => trans('admin.sUrl'),
            'sInfoThousands'     => trans('admin.sInfoThousands'),
            'sLoadingRecords'    => trans('admin.sLoadingRecords'),
            'oPaginate'          => [
                'sFirst'            => trans('admin.sFirst'),
                'sLast'             => trans('admin.sLast'),
                'sNext'             => trans('admin.sNext'),
                'sPrevious'         => trans('admin.sPrevious'),
            ],
            'oAria'            => [
                'sSortAscending'  => trans('admin.sSortAscending'),
                'sSortDescending' => trans('admin.sSortDescending'),
            ],
        ];
    }
}