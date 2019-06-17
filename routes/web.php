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
    return view('index');
});

Route::get('index',function(){
    return view ("sesion");
});

Route::get('sesion',function(){
    return view ("sesion");
});
Route::post('sesion',function(){
    return view ("sesion");
});

Route::post('sesion_helper','SesionesHelper@index');
Route::post('sesion_request','SesionesRequest@index');
Route::post('ActasBorrarSesion',function(){
    session()->flush();
    return view("index");
});
