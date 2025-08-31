<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->bigIncrements('role_id');
            $table->string('role_name');
            $table->timestamps();
        });

        // Insert default roles
        DB::table('user_role')->insert([
            ['role_id' => 1, 'role_name' => 'admin',   'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 2, 'role_name' => 'coach',   'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 3, 'role_name' => 'staff',   'created_at' => now(), 'updated_at' => now()],
            ['role_id' => 4, 'role_name' => 'athlete', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};