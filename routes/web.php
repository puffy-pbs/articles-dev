<?php

Route::get('/', 'ArticleController@index');
Auth::routes();

Route::group(['prefix' => 'admin-area', 'middleware' => 'admin'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/update/{id}', 'UserController@update');
    Route::post('/save', 'UserController@save');
    Route::get('/erase/{id}', 'UserController@erase');
    Route::get('/create', 'UserController@create');
    Route::post('/store', 'UserController@store');
});

Route::get('/articles', 'ArticleController@index');
Route::get('/articles/create', 'ArticleController@create')->middleware('auth');
Route::get('/articles/update/{id}', 'ArticleController@update')->middleware('auth');
Route::get('/articles/erase/{id}', 'ArticleController@erase')->middleware('admin');
Route::post('/articles/save/{id}', 'ArticleController@save')->middleware('auth');
Route::get('/articles/{id}', 'ArticleController@detail');
Route::post('/articles/store', 'ArticleController@store')->middleware('auth');