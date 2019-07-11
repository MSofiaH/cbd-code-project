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

Route::group(array('middleware' => 'auth'), function(){

  Route::get('/actors', 'ActorsController@index')->name('actors');
  Route::get('/movies', 'MoviesController@index')->name('movies');
  Route::get('/movies/{id}/script', 'ScriptsController@get')->name('scripts');
  Route::get('/production_companies', 'ProductionCompaniesController@index')->name('production_companies');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
