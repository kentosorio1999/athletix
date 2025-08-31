<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('participations', function (Blueprint $table) {
            $table->id('participation_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('participant');
            $table->boolean('attendance')->default(false);
            $table->enum('status', ['registered', 'cancelled', 'completed'])->default('registered');
            
            $table->foreign('event_id')
                  ->references('event_id')
                  ->on('events')
                  ->onDelete('cascade');
                  
            $table->foreign('participant')
                  ->references('athlete_id')
                  ->on('athletes')
                  ->onDelete('cascade');
                  
            $table->unique(['event_id', 'participant']);
            $table->index('status');
            $table->index('attendance');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participations');
    }
};