<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect('index');
});


Route::get('register', 'App\Http\Controllers\LoginController@register_form');
Route::post('register', 'App\Http\Controllers\LoginController@do_register');

Route::get('login', function(){
    return view('login');
});

Route::get('/index', function () {
    return view('index');
});



Route::get('home', function() {
    return view('home');
});