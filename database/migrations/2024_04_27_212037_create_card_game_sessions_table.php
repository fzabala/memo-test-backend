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
        Schema::create('card_game_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_session_id');
            $table->boolean('flipped');
            $table->boolean('selected');
            $table->unsignedBigInteger('image_id');
            $table->timestamps();

            $table->foreign('game_session_id')->references('id')->on('game_sessions');
            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_game_sessions');
    }
};
