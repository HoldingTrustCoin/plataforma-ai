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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->integer('role')->default(0);
            $table->string('username')->unique()->nullable();
            $table->string('balance')->default(0);
            $table->longText('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('photo')->default('user.png');
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('dob')->nullable();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('kyc_verified_at')->nullable();
            $table->string('referred_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
