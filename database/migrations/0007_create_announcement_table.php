<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id('announcement_id');
            $table->string('title');
            $table->text('details');
            $table->unsignedBigInteger('posted_by');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('posted_by')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('created_at');
            $table->index(['posted_by', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};