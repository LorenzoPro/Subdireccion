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
    return view('welcome');
});


Route::group(['prefix'=>'administracion','as'=>'admin.'], function(){
  Route::get('/','CalidadController@index');
  Route::resource('admin','CalidadController');

  Route::get('/usuarios','UserController@index');
  Route::resource('usuarios','UserController');

  Route::get('/carreras','CarrerasController@index');
  Route::resource('carreras','CarrerasController');

  Route::get('/indicadores','IndicadoresController@index');
  Route::resource('indicadores','IndicadoresController');

  Route::get('/metas','MetasController@index');
  Route::resource('metas','MetasController');

  Route::get('/calidad','CalidadController@index');
  Route::resource('calidad','CalidadController');

  Route::post('/calidad/ajax','CalidadController@ajax');
  //Route::get('/calidad/Graficas','CalidadController@Graficas');
  Route::get('/calidad/Graficas/{id}/{periodo}','CalidadController@Graficas');


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
