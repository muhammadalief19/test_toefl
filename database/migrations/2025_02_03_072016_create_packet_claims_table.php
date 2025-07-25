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
        Schema::create('packet_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', '_id');
            $table->foreignId('packet_id')->constrained('packets', '_id');
            $table->dateTime('timeStart');
            $table->boolean('is_completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packet_claims');
    }
};
