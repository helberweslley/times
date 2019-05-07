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
    return view('vendor.adminlte.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('time', 'TimeController');
Route::resource('jogo', 'JogoController');
Route::resource('sistema', 'SistemaController');
Route::resource('relationship', 'RelationshipController');
Route::get('/partida/','RelationshipController@ConsultaAjax')->name('partida');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/visualizar', function () {
    return view('relationship.visualizar');
});
Route::get('/teste', function () {
    return view('teste');
});