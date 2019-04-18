<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Jobs\CalculateDistance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CardsController extends Controller
{
    /**
     * 获取用户每天的可选卡片
     *
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        if (!$pre_choices = Cache::get('user:'.Auth::id().':pre_choices')) {
            $cards = Card::where('limit', '<>', 0)->get(); $temp = [];
            foreach ($cards as $card) {
                $temp += [$card->id => $card->possibility];
            }
            $pre_choices = roulette_choose($temp, 3);
            Cache::put('user:'.Auth::id().':pre_choices', $pre_choices, today()->addDay());
        }

        $data = [];
        foreach ($pre_choices as $choice) {
            $card = Card::find($choice);
            $data[] = [
                'id' => $card->id,
                'is_known' => true,
                'name' => $card->name,
                'series' => $card->series->id,
                'src' => config('app.url') . '/storage/cards/thumbnails/' . $card->no . '.jpg',
            ];
        }

        for ($i = 0; $i < 6; $i++) {
            $data[] = [
                'id' => -1,
                'is_known' => false,
                'name' => null,
                'series' => null,
                'src' => config('app.url') . '/storage/cards/0-0.jpg',
            ];
        }

        return $this->response->array($data);
    }

    /**
     * 获取某张卡片详情
     *
     * @param Card $card
     * @return mixed
     */
    public function show(Card $card)
    {
        return $this->response->array([
            'id' => $card->id,
            'name' => $card->name,
            'series' => $card->series_id,
            'src' => config('app.url') . '/storage/cards/photos/' . $card->no . '.jpg',
        ]);
    }

    /**
     * 选择卡片
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function store(Request $request)
    {
        if (!Cache::has('user:'.Auth::id().':pre_choices')) {
            throw new BadRequestHttpException('还未查看已有卡片');
        }
        if (Cache::has('user:'.Auth::id().':choices')) {
            return $this->my();
        }

        $choices = $request->cards;
        $cards = Card::all(); $temp = [];
        foreach ($cards as $card) {
            $temp += [$card->id => $card->possibility];
        }

        $cards = [];
        $pre_choice = Cache::get('user:'.Auth::id().':pre_choices');
        foreach ($choices as $choice) {
            if ($choice == -1) {
                $choice = roulette_choose($temp)[0];
            } elseif (!in_array($choice, $pre_choice)) {
                throw new BadRequestHttpException('选择卡片不在预选范围内');
            }
            $cards[] = (int)$choice;
        }

        Cache::put('user:'.Auth::id().':choices', $cards, today()->addDay());

        $data = [];
        foreach ($cards as $card) {
            $choice = Card::find($card);
            $data[] = [
                'id' => $choice->id,
                'name' => $choice->name,
                'series' => $choice->series->id,
                'src' => config('app.url') . '/storage/cards/thumbnails/' . $choice->no . '.jpg',
                'longitude' => $choice->series->longitude,
                'latitude' => $choice->series->latitude,
            ];
        }

        return $this->response->array($data);
    }

    /**
     * 获取当天已抽取卡片
     *
     * @return mixed
     */
    public function my()
    {
        $cards = Auth::user()->valid_cards()->count();

        return $this->response->array([
            'cards_count' => $cards,
        ]);
    }

    /**
     * @param Card $card
     * @param Request $request
     * @return mixed
     */
    public function update(Card $card, Request $request)
    {
        if ($request->has('longitude', 'latitude') && in_array($card->id, $choice = Cache::get('user:'.Auth::id().':choices'))) {
            DB::table('card_user')->insertGetId([
                'user_id' => Auth::id(),
                'card_id' => $card->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            //更新缓存
            unset($choice[array_search($card->id, $choice)]);
            Cache::put('user:'.Auth::id().':choices', $choice, today()->addDay());

            /** 减少可出卡牌量 */
            $card->decrement('limit');

            /** 统计已出卡牌量 */
            $card->increment('exist');

            return $this->responseWithCards([$card->id])->setStatusCode(201);
        }

        throw new BadRequestHttpException('未填写位置或卡片不在当日允许范围内');
    }

    /**
     * 通用卡片响应
     *
     * @param $cards
     * @return mixed
     */
    public function responseWithCards($cards)
    {
        $data = [];
        foreach ($cards as $card) {
            $choice = Card::find($card);
            $data[] = [
                'id' => $choice->id,
                'name' => $choice->name,
                'series' => $choice->series->id,
                'src' => config('app.url') . '/storage/cards/photos/' . $choice->no . '.jpg',
                'longitude' => $choice->series->longitude,
                'latitude' => $choice->series->latitude,
            ];
        }
        return $this->response->array($data);
    }
}
