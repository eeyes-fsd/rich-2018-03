<?php
return [
    'apps' => [
        'tencent_map_key' => env('TENCENT_MAP_KEY'),
    ],
    'rules' => [
        'min_distance' => env('GAME_MIN_DISTANCE', 100),
    ]
];