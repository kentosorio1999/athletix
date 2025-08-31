<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id('athlete_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('section_id');
            $table->boolean('is_removed')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->foreign('course_id')
                  ->references('course_id')
                  ->on('courses')
                  ->onDelete('cascade');
                  
            $table->foreign('section_id')
                  ->references('section_id')
                  ->on('sections')
                  ->onDelete('cascade');
                  
            $table->unique(['user_id', 'course_id']);
            $table->index('status');
            $table->index('is_removed');
        });
    }

    public function down()
    {
        Schema::dropIfExists('athletes');
    }
};