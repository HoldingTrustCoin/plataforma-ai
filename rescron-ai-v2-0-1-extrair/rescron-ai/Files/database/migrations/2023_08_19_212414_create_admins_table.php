<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('role')->default(0);
            $table->string('photo')->default('user.png');
            $table->timestamps();
        });

        // Insert initial admin data
        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'mrfebuc@gmail.com',
            'password' => Hash::make('password'),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
