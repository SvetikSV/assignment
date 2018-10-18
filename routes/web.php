<?php

Route::get('/', 'ProductsController@index');
Route::get('/add_product', 'ProductsController@addProduct');
Route::post('/add_product', 'ProductsController@addProduct');
