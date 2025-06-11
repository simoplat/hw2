<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
//GET
Route::get('fetchHomeContent', 'App\Http\Controllers\HomeController@getFeed');
Route::get('fetchCategories', 'App\Http\Controllers\HomeController@fetchCategories');
Route::get('fetchChannels', 'App\Http\Controllers\HomeController@fetchChannels');
Route::get('fetchNotification', 'App\Http\Controllers\HomeController@fetchNotification');
Route::get('user/{username}', 'App\Http\Controllers\UserController@getUserPage');
Route::get('fetchChannelContent/{username}','App\Http\Controllers\UserController@fetchChannelContent');
Route::get('post/{id_post}', [PostController::class, 'index'])->name('post.show');
Route::get('fetchPost/{id_post}', [PostController::class, 'fetchPost'])->name('post.fetch');
Route::get('fetchPreferiti',[HomeController::class,'fetchPreferiti']);
Route::get('fetchCommenti/{id_post}',[PostController::class,'aggiornaCommenti']);
Route::get('spotify',[ApiController::class,'spotifyAPI']);
Route::post('youtubeAPI',[ApiController::class,'youtubeAPI']);
//POST
Route::post('checkChannel',[UserController::class,'checkChannel']);
Route::post('toggleIscritto',[UserController::class,'toggleIscritto']);
Route::post('togglePreferito',[PostController::class,'togglePreferito']);
Route::post('aggiungiCommento',[PostController::class,'aggiungiCommento']);
Route::post('dataBaseAction',[ApiController::class,'dbAction']);


//API