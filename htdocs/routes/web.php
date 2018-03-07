<?php

use Illuminate\Http\Request;

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

Route::get('/vue', function () {
    return view('vue');
});

Route::get('/callback', function (Request $request) {
    var_dump('codigo de autorizacao = ' . $request->code);
});

Route::get('/teste_token', function () {
    var_dump('client informou o token de acesso.');
})->middleware('auth:api');

Route::get('/produto/incluir', function () {
	//scopes (and)
	var_dump('client informou o token de acesso com escopo E.');
})->middleware('scopes:produto-consultar,produto-incluir');

Route::get('/produtos', function () {
	//scope (or)
	var_dump('client informou o token de acesso com escopo OU.');
})->middleware('scope:produto-consultar,produto-incluir');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
