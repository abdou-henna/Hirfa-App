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

// These route are any userc specific
//Route::post('login','userController@register');

// These route are user specific 
Route::post('register','userController@register');




// These route are user specific craftsmen 
Route::post('complete_register','craftsmenController@complete_register');//
Route::post('show_information_craftsman','craftsmenController@show_information_craftsman');