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
        Schema::create('quiz_answers_keys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_content_id')->constrained('quiz_contents', '_id');
            $table->foreignId('quiz_option_id')->constrained('quiz_options', '_id');
            $table->string('quiz_options');
            $table->string('explanation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
