<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id('course_id');
            $table->string('course_name');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
            
            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments')
                  ->onDelete('cascade');
                  
            $table->index('course_name');
            $table->index(['department_id', 'course_name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
};