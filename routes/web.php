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

/*
 * MRM Me gustaría probar a usar una instacia de la clase router
use Illuminate\Routing\Router;

Route::get('/', function () {
    return view('index');
});
$d = new \Illuminate\Events\Dispatcher();
$r= new Router($d);

$r->get('index',function(){
    return "<h1> increible </h1>";
});
*/
//curl -X OPTIONS http://localhost:8000/opcion -i //
Route::get("primera", function(){
    return ("<h1>Estás en la página primera con método GET</h1>");
});
Route::get("primera_echo", function(){
    echo ("<h1>Estás en la página primera con método GET</h1>");
});

Route::options('/opcion', function(){
    return "<h1>Qué es esto</h1>";
});


Route::get('basico', function(){
    return "<h1>Esto es un texto básico </h1>";
});


Route::get('pantalla1', function(){
    return view('pantalla1');//Esto es usar un helper
});
/*MRM Esto no funciona*/
Route::get('pantalla2', function(){
    return new View('pantalla2'); //Esto es una facade
});

Route::any('navegar',function(){
    return view('/ppal/navegar');
});
Route::any('about',function(){
    return view('ppal/about');
});
Route::match(['get','post'],'contactar',function(){
    return view('ppal/contactar');
});
Route::any('/principal',function(){
    return view('ppal/principal');
});
Route::any('/noticias',function(){
    return view('ppal/noticias');
});
/*Parametrizando controlando el valor*/
Route::get('/numero/{number?}', function($number=4){
    Return "<h2>Estás en el número $number</h2>";
})->where('number','[0-9]+');

Route::pattern('nom', '[a..zA..Z]+');
Route::get('/nombre/{nom?}', function($nom=null){
    Return "<h2>Estás en el nombre con nombre $nom</h2>";
});
//nombre2 solo mayúscula establecido en RouteServicePorvides
Route::get('/nombre2/{nombre2}', function($nombre2=null){
    Return "<h2>Estás en el nombre 2 con nombre $nombre2</h2>";
});



Route::get('/',function(){
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
Route::fallback(function(){
    return "<h1>No existe esta página </h1>";
});