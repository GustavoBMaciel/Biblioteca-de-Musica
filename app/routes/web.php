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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/musicas', 'Biblioteca\MusicaController');
Route::resource('/users', 'Biblioteca\UserController')->middleware('admins');
Route::resource('/bandas', 'Biblioteca\BandaController');

Route::any('/bandas/create', 'Biblioteca\BandaController@create')->middleware('users');
Route::any('/bandas/{id}/edit', 'Biblioteca\BandaController@edit')->middleware('users');
Route::any('/musicas/create', 'Biblioteca\MusicaController@create')->middleware('users');
Route::any('/musicas/{id}/edit', 'Biblioteca\MusicaController@edit')->middleware('users');
Route::any('/albuns/create', 'Biblioteca\AlbunController@create')->middleware('users');
Route::any('/albuns/{id}/edit', 'Biblioteca\AlbunController@edit')->middleware('users');

Route::resource('/albuns', 'Biblioteca\AlbunController');
Route::any('/pesquisar', 'HomeController@pesquisa')->name('pesquisa');
Route::resource('/adicionamusica', 'Biblioteca\AdicionaController');
