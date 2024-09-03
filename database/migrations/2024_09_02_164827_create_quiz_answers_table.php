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
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_option_id')->constrained('quiz_options', '_id');
            $table->foreignId('quiz_claim_id')->constrained('quiz_claims', '_id');
            $table->foreignId('quiz_content_id')->constrained('quiz_contents', '_id');
            $table->foreignId('user_id')->constrained('users', '_id');
            $table->decimal('score');
            $table->timestamp('created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
