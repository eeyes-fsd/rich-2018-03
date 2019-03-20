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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    //'middleware' => ['serializer:array', 'bindings', 'change-locale'],
], function ($api) {
    $api->group([
        //登录相关 API 限制访问次数
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api) {
        //Code 登录换取 Token
        $api->post('authorizations', 'AuthorizationsController@store')
            ->name('api.authorizations.store');
        //刷新 Token
        $api->put('authorizations/current', 'AuthorizationsController@update')
            ->name('api.authorizations.update');
    });
});
