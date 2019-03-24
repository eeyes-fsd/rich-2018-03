<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CardsController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        if (!$pre_choices = Cache::get('user:'.Auth::id().':pre_choice')) {
            $cards = Card::all(); $temp = [];
            foreach ($cards as $card) {
                $temp += [$card->id => $card->possibility];
            }
            $pre_choices = roulette_choose($temp, 3);
            Cache::put('user:'.Auth::id().':pre_choice', $pre_choices, today()->addDay());
        }

        $data = [];
        foreach ($pre_choices as $choice) {
            $card = Card::find($choice);
            $data[] = [
                'id' => $card->id,
                'is_known' => true,
                'name' => $card->name,
                'series' => $card->series->id,
                'src' => $card->photo,
            ];
        }

        for ($i = 0; $i < 6; $i++) {
            $data[] = [
                'id' => 0,
                'is_known' => false,
                'name' => null,
                'series' => null,
                'src' => 'https://img.eeyes.net/',
            ];
        }

        return $this->response->array($data);
    }
}
