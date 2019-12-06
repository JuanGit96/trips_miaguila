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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/**
 *
 * RUTAS PARA ADMINISTRAR VIAJES
 */

Route::prefix('trips')->group(function () {

    #listado de rutas
    Route::get('/','TripController@index')->name('trips.index');

    #cantidad de rutas
    Route::prefix('/count')->group(function () {

        #cantidad de rutas totales
        Route::get('/','TripController@count')->name('trips.count');

        #rutas totales por ciudad
        Route::post('/','TripController@countByCity')->name('trips.countCity');
    });


    #status de rutas
    Route::prefix('/status')->group(function () {

        #status por ruta
        Route::get('/{trip}','TripController@statusByTrip')->name('trips.statusTrip');

    });


    #creacion de ruta
    Route::post('/','TripController@store')->name('trips.store');

    #visualización de ruta especifica
    Route::get('/{id}','TripController@show')->name('trips.show');

    #edicion-actualización de ruta
    Route::put('/{id}','TripController@update')->name('trips.update');

    #eliminar ruta
    Route::delete('/{id}','TripController@destroy')->name('trips.delete');

});

