<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sports', function (Blueprint $table) {
            $table->id('sport_id');
            $table->string('sport_name');
            $table->timestamps();
            
            $table->index('sport_name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sports');
    }
};