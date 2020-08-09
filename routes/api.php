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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});
// routes for Admin
Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('food', 'FooditemController@index');
    Route::post('food/single', 'FooditemController@show');
    Route::post('menuitems', 'MenuItemController@index');

    Route::group([
      'middleware' => ['auth:api', 'scope:admin']
    ], function () {
        Route::post('food/create', 'FooditemController@store');
        Route::post('food/destroy', 'FooditemController@destro');
        Route::post('menu/create', 'MenuItemController@store');
        Route::post('menu/destroy', 'MenuItemController@destro');
        Route::post('orders', 'OrderController@index');
        Route::post('orders/getUserOrders', 'OrderController@getUserOrders');
    });
});
// routes for User
Route::group([
    'prefix' => 'user'
], function () {
    // write open routes here
    Route::post('food', 'FooditemController@index');
    Route::post('food/single', 'FooditemController@show');
    Route::post('menuitems', 'MenuItemController@index');
    
    Route::group([
      'middleware' => ['auth:api', 'scope:user']
    ], function () {
        //Route::post('orders/create', 'OrderController@store');
        Route::post('orders/getUserOwnOrders', 'OrderController@getUserOwnOrders');
    });
    Route::group([
      'middleware' => ['auth:api']
    ], function () {
        Route::post('orders/create', 'OrderController@store');
    });

});
