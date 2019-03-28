<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Prize;
use App\Models\User;
use Illuminate\Http\Request;

class PrizesController extends Controller
{
    /**
     * 获取所有奖品列表
     * 如果请求时提供 can 参数，则返回可兑换列表
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $prizes = Prize::all(); $user = Auth::user(); $data = [];
        foreach ($prizes as $prize) {
            if ($request->has('can') && !$this->verify_prize($user, $prize)) {
                continue;
            }
            $data[] = [
                'name' => $prize->name,
                'src' => $prize->photo,
                'requirement' => $prize->requirement,
                'remain' => $prize->limit,
            ];
        }


        return $this->response->array($data);
    }

    /**
     * 验证该奖品是否可以兑换
     *
     * @param User $user
     * @param Prize $prize
     * @return bool
     */
    private function verify_prize(User $user, Prize $prize)
    {
        $own_cards = $user->cards;
        $cards = [];

        //整理卡片数量
        foreach ($own_cards as $card) {
            if (!isset($cards[$card->id])) {
                $cards[$card->id] = 0;
            }
            $cards[$card->id] += 1;
        }

        //验证是否可以兑换
        foreach ($prize->requirement as $card => $number) {
            if (!isset($cards[$card]) || $cards[$card] < $number) {
                return false;
            }
        }

        return true;
    }
}
