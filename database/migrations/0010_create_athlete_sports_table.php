<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('athlete_sports', function (Blueprint $table) {
            $table->id('athlete_sport_id');
            $table->unsignedBigInteger('sport_id');
            $table->unsignedBigInteger('athlete_id');
            
            $table->foreign('sport_id')
                  ->references('sport_id')
                  ->on('sports')
                  ->onDelete('cascade');
                  
            $table->foreign('athlete_id')
                  ->references('athlete_id')
                  ->on('athletes')
                  ->onDelete('cascade');
                  
            $table->unique(['sport_id', 'athlete_id']);
            $table->index('athlete_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('athlete_sports');
    }
};