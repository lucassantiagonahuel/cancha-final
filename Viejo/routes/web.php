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

Route::any('/','LoginController@index');

Route::any('/inicio','HomeController@index');
Route::get('/clientes','ClientesController@index');
Route::get('/turnos','TurnosController@index');
Route::get('/cobranzas','CobranzasController@index');
Route::get('/soporte', 'SoporteController@index');


