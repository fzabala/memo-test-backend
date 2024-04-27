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
        Schema::create('game_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('memo_test_id');
            $table->integer('retries');
            $table->integer('number_of_pairs');
            $table->enum('state', ["STARTED", "COMPLETED"]);
            $table->timestamps();

            $table->foreign('memo_test_id')->references('id')->on('memo_tests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_sessions');
    }
};
