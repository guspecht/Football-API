<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('home_team');
            $table->integer('away_team');
            $table->integer('home_result');
            $table->integer('away_result');
            $table->string('date');
            $table->string('match_type');

            // Foreign KEYS
            $table->foreignId('stadiums_id');
            $table->foreignId('groups_id');
            
            // Relations
            // stadiums relation ONE stadium N matches
            $table->foreign('stadiums_id')->references('id')->on('stadiums');
            // groups relation ONE group N matches
            $table->foreign('groups_id')->references('id')->on('groups');
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
        Schema::dropIfExists('matches');
    }
}
