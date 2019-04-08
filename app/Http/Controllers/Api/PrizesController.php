<?php

namespace App\Http\Controllers\Api;

use Auth;
use Exception;
use App\Models\Prize;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
        $prizes = Prize::where('limit', '>', 0)->get(); $user = Auth::user(); $data = [];
        foreach ($prizes as $prize) {
            if ($request->has('can') && !$this->verify_prize($user, $prize)) {
                continue;
            }
            $data[] = [
                'id' => $prize->id,
                'name' => $prize->name,
                'description' => $prize->description,
                'src' => $prize->photo,
                'requirement' => $prize->requirement,
                'remain' => $prize->limit,
            ];
        }


        return $this->response->array($data);
    }

    /**
     * 获取某个奖品详情，包含能否兑换
     *
     * @param Prize $prize
     * @return mixed
     */
    public function show(Prize $prize)
    {
        return $this->response->array([
            'id' => $prize->id,
            'name' => $prize->name,
            'description' => $prize->description,
            'src' => $prize->photo,
            'requirement' => $prize->requirement,
            'remain' => $prize->limit,
            'can' => $this->verify_prize(Auth::user(), $prize),
        ]);
    }

    public function store(Prize $prize)
    {
        if (!$this->verify_prize(Auth::user(), $prize)) {
            throw new BadRequestHttpException('该奖品当前不可兑换');
        }

        $cards = [];
        foreach ($prize->requirement as $card => $number) {
            for ($i = 0; $i < $number; $i++) {
                array_push($cards, $card);
            }
        }

        try {
            foreach ($cards as $card) {
                $id = DB::table('card_user')->whereNull('deleted_at')->where('user_id', Auth::id())->where('card_id', $card)->value('id');
                DB::table('card_user')->where('id', $id)->update(['deleted_at' => now()]);
            }
        } catch (Exception $exception) {
            throw new BadRequestHttpException('兑换出错，请联系管理员');
        }

        $id = DB::table('prize_user')->insertGetId([
            'key' => Uuid::uuid1(),
            'user_id' => Auth::id(),
            'prize_id' => $prize->id,
            'available' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $prize->decrement('limit');

        $uuid = DB::table('prize_user')->where('id', $id)->value('key');

        return $this->response->array([
            'uuid' => $uuid,
            'name' => $prize->name,
            'description' => $prize->description,
            'src' => $prize->photo,
        ])->setStatusCode(201);
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
        $own_cards = $user->valid_cards();
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
