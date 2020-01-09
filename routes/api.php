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

Route::get('/ok', function(){
	return ['status'=>true];
});

Route::namespace('API')->name('api.')->group(function(){
	
	Route::prefix('products')->group(function(){
		
		Route::get('/', 'ProductsController@index')->name('index_products');
		
		Route::get('/{id}', 'ProductsController@show')->name('single_products');

		Route::post('/', 'ProductsController@store')->name('store_products');

		Route::put('/{id}', 'ProductsController@update')->name('update_products');

		Route::delete('/{id}', 'ProductsController@delete')->name('delete_products');
	});

});

Route::post('/login', 'Api\AuthController@login');
Route::post('/register', 'Api\AuthController@register');
Route::middleware('auth:api')->get('/user', function (Request $request) {
return $request->user();
});