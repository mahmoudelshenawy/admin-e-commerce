<?php


Route::get('/', function () {
    return redirect(aurl('login'));
});






Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';

    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');

    return back();
});
