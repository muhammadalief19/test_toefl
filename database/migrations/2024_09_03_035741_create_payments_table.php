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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', '_id');
            $table->foreignId('course_id')->constrained('courses', '_id');
            $table->decimal('amount', 10, 2);
            $table->string('payment_method');
            $table->timestamp('payment_date');
            $table->enum('transaction_status', ['pending', 'completed', 'failed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
