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
        Schema::create('word_lists', function (Blueprint $table) {
            $table->id();
            $table->string("Answer");
            $table->string("Meaning");
            $table->string("Examples/0");
            $table->string("Examples/1");
            $table->string("Examples/2");
            $table->string("Examples/3");
            $table->string("Examples/4");
            $table->string("Examples/5");
            $table->string("Examples/6");
            $table->string("Examples/7");
            $table->string("Examples/8");
            $table->string("Examples/9");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_lists');
    }
};
