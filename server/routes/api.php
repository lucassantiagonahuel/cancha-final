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


Route::post('/','Api\LoginController@index');
Route::post('/inicio','Api\HomeController@index');
Route::post('/turnos','Api\TurnosController@index');
Route::post('/cobranzas','Api\CobranzasController@index');
Route::post('/soporte', 'Api\SoporteController@index');


/**************** CLIENTES *******************/
Route::post('/clientes','Api\ClientesController@index');
Route::post('/clientes/store','Api\ClientesController@store');
Route::post('/clientes/get','Api\ClientesController@get');
Route::post('/clientes/edit','Api\ClientesController@edit');
Route::post('/clientes/delete','Api\ClientesController@delete');

