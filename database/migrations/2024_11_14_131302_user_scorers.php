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
        Schema::create('user_scorers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', '_id');
            $table->foreignId('packet_id')->constrained('packets', '_id');
            $table->string('akurasi');
            $table->string('level_profiency');
            $table->string('score_toefl');
            $table->string('score_listening');
            $table->string('score_structure');
            $table->string('score_reading');
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
