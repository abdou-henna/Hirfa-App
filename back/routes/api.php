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
//Route::post('login','userController@register');//
Route::post('get_crafts','craftsmenController@get_craft');
// These route are user specific 
Route::post('register','userController@register');//
Route::post('request_projects','ProjectController@request_register');
Route::get('projects','ProjectController@getProjects');




// These route are user specific craftsmen 
Route::post('complete_register','craftsmenController@complete_register');//get_craftsman
Route::post('show_information_craftsman','craftsmenController@show_information_craftsman');
Route::post('update_craftsman','craftsmenController@update_craftsman');
Route::post('index_craftsman','craftsmenController@get_craftsman');