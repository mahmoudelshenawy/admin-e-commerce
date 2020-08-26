<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');

    Route::get('login', 'Admin@login');
    Route::post('login', 'Admin@finishLogin')->name('login');

    Route::get('/forgot/password', 'Admin@forgotPassword');
    Route::post('/forgot/password', 'Admin@getTokenToReset');
    Route::get('/reset/password/{token}', 'Admin@getResetPassword');

    Route::post('/reset/password/{token}', 'Admin@postResetPassword');

    Route::group(['middleware' => 'admin:admin'], function () {

        Route::resource('admins', 'Admin');
        Route::resource('users', 'Users');
        Route::resource('countries', 'Countries');
        Route::resource('cities', 'Cities');
        Route::resource('states', 'States');
        Route::resource('departments', 'Departments');
        Route::resource('trademarks', 'TradeMarks');
        Route::resource('manufacturers', 'Manufacturers');
        Route::resource('shippings', 'Shippings');
        Route::resource('malls', 'Malls');
        Route::resource('colors', 'Colors');
        Route::resource('categories', 'Categories');
        Route::resource('units', 'Units');
        Route::resource('sizes', 'Sizes');
        Route::resource('products', 'Products');
        Route::resource('purchases', 'Purchases');

        Route::post('upload/image/{id}', 'Products@uploadImages');

        // Route::post('products/filter', 'Products@filter');

        Route::post('update/product/image/{id}', 'Products@updateProductImage');

        Route::post('delete/image', 'Products@deleteImages');

        Route::post('delete/product/image/{id}', 'Products@deleteProductImage');

        Route::post('products/get_size_of_unit/{id}', 'Products@getSizesOfUnit');
        Route::post('products/copy/{id}', 'Products@copyProduct');

        Route::delete('products/delete/all', 'Products@multi_delete')->name('products.multi_delete');

        Route::delete('countries/delete/all', 'Countries@multi_delete')->name('countries.multi_delete');

        Route::delete('admins/delete/all', 'Admin@multi_delete')->name('admins.multi_delete');

        Route::delete('trademarks/delete/all', 'TradeMarks@multi_delete')->name('trademarks.multi_delete');

        Route::delete('manufacturers/delete/all', 'Manufacturers@multi_delete')->name('manufacturers.multi_delete');

        Route::delete('shippings/delete/all', 'Shippings@multi_delete')->name('shippings.multi_delete');

        Route::delete('malls/delete/all', 'Malls@multi_delete')->name('malls.multi_delete');

        Route::delete('colors/delete/all', 'Colors@multi_delete')->name('colors.multi_delete');

        Route::delete('categories/delete/all', 'Categories@multi_delete')->name('categories.multi_delete');
        Route::delete('units/delete/all', 'Units@multi_delete')->name('units.multi_delete');

        Route::delete('purchases/delete/all', 'Purchases@multi_delete')->name('purchases.multi_delete');


        Route::get('settings', 'Settings@showSettings');
        Route::post('settings', 'Settings@saveSettings');

        Route::any('logout', 'Admin@logout');
    });
});
