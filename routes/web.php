<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    redirect('login');
});


Route::get('register', 'App\Http\Controllers\LoginController@register_form');
Route::post('register', 'App\Http\Controllers\LoginController@do_register');