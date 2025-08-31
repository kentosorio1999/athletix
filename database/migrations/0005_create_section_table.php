<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id('section_id');
            $table->string('section_name');
            $table->string('year_level');
            $table->timestamps();
            
            $table->index(['section_name', 'year_level']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sections');
    }
};