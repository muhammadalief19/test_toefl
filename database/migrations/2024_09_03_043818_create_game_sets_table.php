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
        Schema::create('game_sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes', '_id');
            $table->foreignId('game_id')->constrained('games', '_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sets');
    }
};
