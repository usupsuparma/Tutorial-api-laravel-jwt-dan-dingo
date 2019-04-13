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

$api = app('Dingo\Api\Routing\Router');
// tidak dengan token
$api->version('v1', function ($api) {
    $api->post('user/register', 'App\Http\Controllers\ApiRegisterController@register');
    $api->post('user/login', 'App\Http\Controllers\ApiLoginController@login');
});

// harus menggunakan token
$api->version('v1', ['middleware' => ['jwt.auth']], function ($api) {
    $api->get('getUser', 'App\Http\Controllers\ApiLoginController@getUser');
});

