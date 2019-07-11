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
Route::apiResource('actors','Api\ActorsController');
Route::apiResource('movies','Api\MoviesController');
Route::apiResource('production_companies','Api\ProductionCompaniesController');
Route::apiResource('scripts','Api\ScriptsController');