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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('film', 'FilmController');
Route::resource('genre', 'GenreController');
Route::get('/favori', 'FavoriController@listFavori')->name('favori.index');
Route::get('/favori/add/{film}', 'FavoriController@addFavori')->name('favori.store');
Route::get('/favori/delete/{film}', 'FavoriController@destroyFavori')->name('favori.destroy');
