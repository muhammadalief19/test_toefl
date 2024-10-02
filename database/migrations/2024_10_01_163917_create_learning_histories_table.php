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
        Schema::create('learning_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_id', '_id');
            $table->foreignId('course_id')->constrained('course_id', '_id');
            $table->foreignId('module_id')->constrained('module_id', '_id');
            $table->dateTime('completion_date')->nullable();
            $table->float('progress')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_histories');
    }
};
