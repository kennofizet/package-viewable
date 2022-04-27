<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLookViewByUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('look_view_by_user', function (Blueprint $table) {
            $table->id();
            $table->longText('total_view');
            // time and total view h d m y
            $table->integer('time_view');
            // 1= h , 2 = d, 3 = m, 4 = y, 5 = total;
            $table->integer('time_current');
            $table->longText('time_show');
            $table->bigInteger('chart_check')->default(0);
            $table->longText('model');
            $table->integer('model_id');
            $table->integer('user_id');
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
        Schema::dropIfExists('look_view_by_user');
    }
}
