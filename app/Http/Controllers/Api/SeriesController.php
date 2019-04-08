<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Models\Series;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Series::all();
        $data = [];
        foreach ($series as $serie) {
            $data[] = [
                'id' => $serie->id,
                'name' => $serie->name,
            ];
        }

        return $this->response->array($data);
    }

    public function show(Series $series)
    {
        $my_cards = Auth::user()->cards();
        $cards = $series->cards;

        foreach ($cards as $card) {
            foreach ($my_cards as $my_card) {
                if ($card->id == $my_card->id) {
                    $card->count = $card->count + 1;
                }
            }
        }

        $data = [];
        foreach ($cards as $card) {
            $data[] = [
                'id' => $card->id,
                'name' => $card->name,
                'src' => $card->photo,
                'count' => $card->count ? $card->count : 0,
            ];
        }

        return $this->response->array($data);
    }
}
