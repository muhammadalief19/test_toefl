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
        Schema::create('nesteds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained('questions', '_id');
            $table->foreignId('nested_question_id')->constrained('nested_questions', '_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nesteds');
    }
};
