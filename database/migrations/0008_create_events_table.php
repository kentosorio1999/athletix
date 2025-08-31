<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->time('event_time');
            $table->date('event_date');
            $table->text('details');
            $table->string('category');
            $table->unsignedBigInteger('created_by');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('created_by')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index(['event_date', 'event_time']);
            $table->index('category');
            $table->index('created_by');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};