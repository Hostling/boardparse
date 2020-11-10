<?php


Route::get('', 'BoardController@index');
Route::post('1', 'BoardController@kolvo')->name('kolvo');
Route::get('createOb', 'BoardController@createOb')->name('createOb');
Route::get('create', 'BoardController@created')->name('created');
Route::post('create', 'BoardController@crkolvo')->name('crkolvo');

Route::get('sandbox', 'BoardController@sandbox')->name('sandbox');