<?php

use App\Models\User;
use App\Models\Card;
use App\Models\Series;
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
                'longitude' => 34.2459287354,
                'latitude' => 108.9839240659,
            ],
            [
                'name' => '卡布达巨人',
                'longitude' => 34.2468757354,
                'latitude' => 108.9837800659,
            ],
            [
                'name' => '亚洲第一食堂',
                'longitude' => 34.2449447354,
                'latitude' => 108.9857270659,
            ],
            [
                'name' => '一柱擎天',
                'longitude' => 34.2447647354,
                'latitude' => 108.9837530659,
            ],
        ];

        foreach ($series as $serie) {
            Series::create($serie);
        }

        $cards = [
            [
                'name' => '东方也有MIT',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '徐家汇开始的迁徙',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '定居，西安城',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '成立，西安交大',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '下沉，再升起',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '传承，新篇章',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 1,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '巨人',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '女神',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '司南',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '造纸术',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '印刷术',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '火药',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 2,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '不来块掉渣饼嘛？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '饭后来块大鸡排？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '好吃还是梧桐苑！',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '康桥还是梧桐？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '米线三鲜还是麻辣？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '铁板饭今天人多吗？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '亚洲第一康桥苑！',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '蒸菜还是清真食堂？',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 3,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '主楼E',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 4,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '主楼A',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 4,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '主楼B',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 4,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '主楼C',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 4,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
            [
                'name' => '主楼D',
                'photo' => 'https://img.eeyes.net',
                'series_id' => 4,
                'possibility' => 0.189,
                'limit' => 100,
                'exist' => 0
            ],
        ];

        foreach ($cards as $card) {
            Card::create($card);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
