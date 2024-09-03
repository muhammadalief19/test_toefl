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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', '_id');
            $table->foreignId('question_id')->constrained('quiz_questions', '_id');
            $table->foreignId('packet_id')->constrained('packets', '_id');
            $table->foreignId('quiz_id')->constrained('quizzes', '_id');
            $table->string('bookmark');
            $table->string('selected_answer');
            $table->boolean('is_correct');
            $table->timestamp('answered_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
