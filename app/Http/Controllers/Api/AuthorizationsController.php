<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\AuthorizationRequest;

class AuthorizationsController extends Controller
{
    /**
     * 通过小程序 Code 登录
     *
     * @param AuthorizationRequest $requests
     */
    public function store(AuthorizationRequest $requests)
    {
        $code = $requests->post('code');

        $miniProgram = \EasyWeChat::miniProgram();
        $data = $miniProgram->auth->session($code);

        if (isset($data['errcode'])) {
            return $this->response->errorUnauthorized('code 错误');
        }

        if (!$user = User::where('weapp_openid', $data['openid'])->first()) {
            $user = User::create([
                'weapp_openid' => $data['openid'],
                'weixin_session_key' => $data['session_key'],
            ]);
        }
        $token = Auth::guard('api')->fromUser($user);
        return $this->respondWithToken($token)->setStatusCode(201);
    }

    /**
     * 更新 Token
     *
     * @return mixed
     */
    public function update()
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    /**
     * 认证后返回 Json Web Token
     *
     * @param $token
     * @return mixed
     */
    public function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }
}
