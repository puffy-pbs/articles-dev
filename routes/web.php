<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    dump(\Illuminate\Support\Facades\Auth::user()->roles);
    dump(\Illuminate\Support\Facades\Gate::allows('admin-area'));
     return view('welcome');
});

Route::get('/admin-area');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
