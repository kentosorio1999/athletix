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
            $table->date('date');
            $table->string('venue')->nullable();
            $table->timestamps(); // adds both created_at and updated_at automatically

            $table->foreign('posted_by')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
};