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

        Series::create([]);

        Card::create([]);
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
