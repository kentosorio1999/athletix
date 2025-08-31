<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id');
            $table->unsignedBigInteger('announcement_id');
            $table->boolean('is_seen')->default(false);
            $table->timestamp('seen_at')->nullable();
            $table->unsignedBigInteger('send_to');
            $table->text('content');
            
            $table->foreign('announcement_id')
                  ->references('announcement_id')
                  ->on('announcements')
                  ->onDelete('cascade');
                  
            $table->foreign('send_to')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('is_seen');
            $table->index(['send_to', 'is_seen']);
            $table->index('seen_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};