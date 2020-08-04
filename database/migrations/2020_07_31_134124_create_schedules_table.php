<?php

use App\Enums\GroupsNameEnum;
use App\Enums\LevelsEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('due_date');
            $table->unsignedBigInteger('competition_id');
            $table->enum('level', LevelsEnum::getValues());
            $table->enum('group', GroupsNameEnum::getValues());
            $table->unsignedBigInteger('home_id')->nullable();
            $table->unsignedBigInteger('away_id')->nullable();
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->unsignedTinyInteger('home_goals')->nullable();
            $table->unsignedTinyInteger('away_goals')->nullable();
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
        Schema::dropIfExists('schedules');
    }
}
