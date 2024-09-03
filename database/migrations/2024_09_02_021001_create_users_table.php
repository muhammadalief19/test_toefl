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
            $table->foreignId('target_id')->nullable()->constrained('targets', '_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamp('registration_date')->nullable();
            $table->string('profile_picture')->nullable();
            $table->enum('status', ['active', 'inactive'])->nullable();
            $table->string('prodi');
            $table->string('nrp');
            $table->foreignId('role')->constrained('user_roles');
            $table->boolean('is_verified_register')->nullable();
            $table->string('otp_register')->nullable();
            $table->boolean('is_verified_forgot')->nullable();
            $table->string('otp_forgot')->nullable();
            $table->timestamp('otp_forgot_expired_at')->nullable();
            $table->timestamp('otp_register_expired_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
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
