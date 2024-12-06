<?php
// Routes/web.php
Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('provinces', 'ProvinceController');
    Route::resource('cities', 'CityController');
    Route::get('provinces/{province}/cities', 'ProvinceController@cities')->name('provinces.cities');
});