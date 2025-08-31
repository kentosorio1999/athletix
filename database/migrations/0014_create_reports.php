<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('generated_by');
            $table->enum('type', ['athlete', 'event', 'participation', 'performance', 'other']);
            $table->timestamp('generated_at')->useCurrent();
            
            $table->foreign('generated_by')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('cascade');
                  
            $table->index('type');
            $table->index('generated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
};