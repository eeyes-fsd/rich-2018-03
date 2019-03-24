<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('卡牌名');
            $table->string('photo')->comment('牌组图片');
            $table->integer('series_id')->comment('牌组ID');
            $table->double('possibility')->comment('刷新概率');
            $table->integer('limit')->comment('上限数目');
            $table->integer('exist')->comment('已出数目');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}
