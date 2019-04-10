<?php

use App\Models\User;
use App\Models\Card;
use App\Models\Series;
use App\Models\Prize;
use Illuminate\Database\Migrations\Migration;

class AddInitialDataToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'role' => 'admin'
        ]);

        $series = [
            [
                'name' => '大树西迁',
                'longitude' => 108.9839240659,
                'latitude' => 34.2459287354,
            ],
            [
                'name' => '卡布达巨人',
                'longitude' => 108.9837800659,
                'latitude' => 34.2468757354,
            ],
            [
                'name' => '亚洲第一食堂',
                'longitude' => 108.9857270659,
                'latitude' => 34.2449447354,
            ],
            [
                'name' => '一柱擎天',
                'longitude' => 108.9837530659,
                'latitude' => 34.2447647354,
            ],
            [
                'name' => '书院',
                'longitude' => 108.9837530659,
                'latitude' => 34.2447647354,
            ],
        ];

        foreach ($series as $serie) {
            Series::create($serie);
        }

        $cards = [
            [
                'name' => '东方也有MIT',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-1.png',
                'series_id' => 1,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '徐家汇开始的迁徙',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-2.png',
                'series_id' => 1,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '定居，西安城',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-3.png',
                'series_id' => 1,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '成立，西安交大',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-4.png',
                'series_id' => 1,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '下沉，再升起',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-5.png',
                'series_id' => 1,
                'possibility' => 0.15,
                'limit' => 30,
                'exist' => 0
            ],
            [
                'name' => '传承，新篇章',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/1-6.png',
                'series_id' => 1,
                'possibility' => 0.03,
                'limit' => 10,
                'exist' => 0
            ],
            [
                'name' => '巨人',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-1.png',
                'series_id' => 2,
                'possibility' => 0.03,
                'limit' => 10,
                'exist' => 0
            ],
            [
                'name' => '女神',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-2.png',
                'series_id' => 2,
                'possibility' => 0.15,
                'limit' => 30,
                'exist' => 0
            ],
            [
                'name' => '司南',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-3.png',
                'series_id' => 2,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '造纸术',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-4.png',
                'series_id' => 2,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '印刷术',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-5.png',
                'series_id' => 2,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '火药',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/2-6.png',
                'series_id' => 2,
                'possibility' => 5.4,
                'limit' => 1300,
                'exist' => 0
            ],
            [
                'name' => '不来块掉渣饼嘛？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-1.png',
                'series_id' => 3,
                'possibility' => 6.6,
                'limit' => 1500,
                'exist' => 0
            ],
            [
                'name' => '饭后来块大鸡排？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-2.png',
                'series_id' => 3,
                'possibility' => 6.6,
                'limit' => 1500,
                'exist' => 0
            ],
            [
                'name' => '好吃还是梧桐苑！',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-3.png',
                'series_id' => 3,
                'possibility' => 0.03,
                'limit' => 10,
                'exist' => 0
            ],
            [
                'name' => '康桥还是梧桐？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-4.png',
                'series_id' => 3,
                'possibility' => 0.85,
                'limit' => 200,
                'exist' => 0
            ],
            [
                'name' => '米线三鲜还是麻辣？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-5.png',
                'series_id' => 3,
                'possibility' => 6.6,
                'limit' => 1500,
                'exist' => 0
            ],
            [
                'name' => '铁板饭今天人多吗？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-6.png',
                'series_id' => 3,
                'possibility' => 6.6,
                'limit' => 1500,
                'exist' => 0
            ],
            [
                'name' => '亚洲第一康桥苑！',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-7.png',
                'series_id' => 3,
                'possibility' => 0.12,
                'limit' => 30,
                'exist' => 0
            ],
            [
                'name' => '蒸菜还是清真食堂？',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/3-8.png',
                'series_id' => 3,
                'possibility' => 6.6,
                'limit' => 1500,
                'exist' => 0
            ],
            [
                'name' => '主楼E',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/4-1.png',
                'series_id' => 4,
                'possibility' => 0.03,
                'limit' => 10,
                'exist' => 0
            ],
            [
                'name' => '主楼A',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/4-2.png',
                'series_id' => 4,
                'possibility' => 4.5,
                'limit' => 1200,
                'exist' => 0
            ],
            [
                'name' => '主楼B',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/4-3.png',
                'series_id' => 4,
                'possibility' => 4.5,
                'limit' => 1200,
                'exist' => 0
            ],
            [
                'name' => '主楼C',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/4-4.png',
                'series_id' => 4,
                'possibility' => 4.5,
                'limit' => 1200,
                'exist' => 0
            ],
            [
                'name' => '主楼D',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/4-5.png',
                'series_id' => 4,
                'possibility' => 4.5,
                'limit' => 1200,
                'exist' => 0
            ],
            [
                'name' => '崇实书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-1.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '南洋书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-2.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '励志书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-3.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '彭康书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-4.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '钱学森书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-5.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '仲英书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-6.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
            [
                'name' => '文治书院',
                'photo' => 'https://rich.eeyes.xyz/storage/photos/5-7.png',
                'series_id' => 5,
                'possibility' => 0.63,
                'limit' => 150,
                'exist' => 0
            ],
        ];

        foreach ($cards as $card) {
            Card::create($card);
        }

        $prizes = [
            [
                'name' => '一柱擎天一等奖',
                'photo' => 'https://i0.hdslb.com/bfs/article/33fef42dbebeae2bbf020c47c5627bb3756dcb2e.jpg',
                'description' => '就是个奖品',
                'requirements' => serialize([[
                    21 => 1,
                    22 => 1,
                    23 => 1,
                    24 => 1,
                    25 => 1,
                ]]),
                'limit' => 2
            ],
            [
                'name' => '卡布达巨人一等奖',
                'photo' => 'https://i0.hdslb.com/bfs/article/33fef42dbebeae2bbf020c47c5627bb3756dcb2e.jpg',
                'description' => '就是个奖品',
                'requirements' => serialize([[
                    7 => 1,
                    8 => 1,
                    9 => 1,
                    10 => 1,
                    11 => 1,
                    12 => 1,
                ]]),
                'limit' => 1
            ],
            [
                'name' => '大树西迁一等奖',
                'photo' => 'https://i0.hdslb.com/bfs/article/33fef42dbebeae2bbf020c47c5627bb3756dcb2e.jpg',
                'description' => '就是个奖品',
                'requirements' => serialize([[
                    1 => 1,
                    2 => 1,
                    3 => 1,
                    4 => 1,
                    5 => 1,
                    6 => 1,
                ]]),
                'limit' => 1
            ],
            [
                'name' => '传奇书院一等奖',
                'photo' => 'https://i0.hdslb.com/bfs/article/33fef42dbebeae2bbf020c47c5627bb3756dcb2e.jpg',
                'description' => '就是个奖品',
                'requirements' => serialize([[
                    26 => 1,
                    27 => 1,
                    28 => 1,
                    29 => 1,
                    30 => 1,
                    31 => 1,
                    32 => 1,
                ]]),
                'limit' => 1
            ],
            [
                'name' => '两苑一等奖',
                'photo' => 'https://i0.hdslb.com/bfs/article/33fef42dbebeae2bbf020c47c5627bb3756dcb2e.jpg',
                'description' => '就是个奖品',
                'requirements' => serialize([[
                    13 => 1,
                    14 => 1,
                    15 => 1,
                    16 => 1,
                    17 => 1,
                    18 => 1,
                    19 => 1,
                    20 => 1,
                ]]),
                'limit' => 1
            ],
        ];

        foreach ($prizes as $prize) {
            Prize::create($prize);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (Card::all() as $card) {
            $card->delete();
        }

        foreach (Series::all() as $card) {
            $card->delete();
        }

        foreach (User::all() as $card) {
            $card->delete();
        }
    }
}
