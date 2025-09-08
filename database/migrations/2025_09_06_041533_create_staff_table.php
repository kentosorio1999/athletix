<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('staff', function (Blueprint $table) {
        $table->id('staff_id');
        $table->unsignedBigInteger('user_id');
        $table->string('full_name')->index();
        $table->string('position')->nullable();
        $table->integer('removed')->default(0)->index();
        $table->timestamps();

        $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        $table->index('user_id');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
