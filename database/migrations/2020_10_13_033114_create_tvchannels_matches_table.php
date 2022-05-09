<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTvchannelsMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tvchannels_matches', function (Blueprint $table) {
            $table->id();

            $table->integer('tvchannels_id');
            $table->foreign('tvchannels_id')
                  ->references('id')
                  ->on('tvchannels')->onDelete('cascade');

            $table->integer('matches_id');
            $table->foreign('matches_id')
                  ->references('id')
                  ->on('matches')->onDelete('cascade');

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
        Schema::dropIfExists('tvchannels_matches');
    }
}
