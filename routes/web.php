<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('index');
});


Route::get('register', 'App\Http\Controllers\LoginController@register_form');
Route::post('register', 'App\Http\Controllers\LoginController@do_register');

Route::get('login', function () {
    return view('login');
});

Route::get('index', function () {
    return view('index');
});

Route::get('login', 'App\Http\Controllers\LoginController@login_form');
Route::post('login', 'App\Http\Controllers\LoginController@do_login');
Route::get('logout', 'App\Http\Controllers\LoginController@logout');


Route::get('home', 'App\Http\Controllers\HomeController@home');

//API PHP
Route::get('fetchHomeContent', 'App\Http\Controllers\HomeController@getFeed');
Route::get('fetchCategories', 'App\Http\Controllers\HomeController@fetchCategories');
Route::get('fetchChannels', 'App\Http\Controllers\HomeController@fetchChannels');
Route::get('fetchNotification', 'App\Http\Controllers\HomeController@fetchNotification');
Route::get('user/{username}', 'App\Http\Controllers\UserController@getUserPage');
Route::get('fetchChannelContent/{username}','App\Http\Controllers\UserController@fetchChannelContent');
Route::get('post/{id_post}',[PostController::class,'index']);
Route::get('fetchPost/{id_post}',[PostController::class,'fetchPost']);
