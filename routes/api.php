<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // Route::post('user_create','UserController@store');


Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth:api'
],function () {
    Route::resource('users', 'UserController'); // dowload excel file on GET request;
});
