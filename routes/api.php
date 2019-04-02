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
    'middleware' => ['bindings'],
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

    $api->group(['middleware' => 'api.auth'], function ($api) {
        //需要认证才能访问的接口
        $api->get('cards', 'CardsController@index')
            ->name('api.cards.index');
        $api->post('cards', 'CardsController@store')
            ->name('api.cards.store');
        $api->get('cards/my', 'CardsController@my')
            ->name('api.cards.my');
        $api->put('cards/{card}', 'CardsController@update')
            ->name('api.cards.update');

        $api->get('prizes', 'PrizesController@index')
            ->name('api.prizes.index');
        $api->get('prizes/{prize}', 'PrizesController@show')
            ->name('api.prizes.show');
        $api->post('prizes/{prize}', 'PrizesController@store')
            ->name('api.prizes.store');
    });

    $api->get('cards/{card}', 'CardsController@show')
        ->name('api.cards.show');
});
