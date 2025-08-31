<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('username')->unique();
            $table->string('password');

            // Optional fields
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();

            $table->string('profile_image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps(); // ✅ created_at + updated_at

            // Foreign key only if role_id is used
            $table->foreign('role_id')
                ->references('role_id')
                ->on('user_role')
                ->onDelete('cascade');

            $table->index('username');
            $table->index('status');
        });

        DB::table('users')->insert([
            'username' => 'admin.athletix.ph@ctu.com',
            'password' => Hash::make('Admin@Athletix'),
            'first_name' => 'Administrator',
            'last_name' => 'athletix',
            'status'   => 'active',
            'role_id'  => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};