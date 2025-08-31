<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->id('performance_id');
            $table->unsignedBigInteger('athlete_id');
            $table->unsignedBigInteger('event_id');
            $table->text('performance_feedback');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('athlete_id')
                  ->references('athlete_id')
                  ->on('athletes')
                  ->onDelete('cascade');
                  
            $table->foreign('event_id')
                  ->references('event_id')
                  ->on('events')
                  ->onDelete('cascade');
                  
            $table->unique(['athlete_id', 'event_id']);
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('performances');
    }
};