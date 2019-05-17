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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// 无需token验证
Route::group([], function ($router) {
    // login
    $router->post('wxLogin', 'User\UserController@wxLogin');
});

Route::group(['middleware' => 'auth:api'], function ($router) {
    // login
    // $router->post('wxLogin', 'User\UserController@wxLogin');
    $router->get('demo', 'User\UserController@demo');
});


// 需要token验证
Route::get('/', function () {
    // return view('welcome');
    echo 'cc';
});
