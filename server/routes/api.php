<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::post('/login','Api\LoginController@index');
Route::post("/cerrarSession",'Api\LoginController@cerrarSession');


/**************** CLIENTES *******************/
Route::post('/clientes','Api\ClientesController@index');
Route::post('/clientes/store','Api\ClientesController@store');
Route::post('/clientes/get','Api\ClientesController@get');
Route::post('/clientes/edit','Api\ClientesController@edit');
Route::post('/clientes/delete','Api\ClientesController@delete');

/**************** TURNOS *******************/
Route::post('/turnos','Api\TurnosController@index');
Route::post('/turnos/store','Api\TurnosController@store');
Route::post('/turnos/get','Api\TurnosController@get');
Route::post('/turnos/edit','Api\TurnosController@edit');
Route::post('/turnos/delete','Api\TurnosController@delete');

/**************** CAJA *******************/
Route::post('/caja','Api\CajaController@index');
Route::post('/caja/store','Api\CajaController@store');
Route::post('/caja/get','Api\CajaController@get');
Route::post('/caja/edit','Api\CajaController@edit');
Route::post('/caja/delete','Api\CajaController@delete');
