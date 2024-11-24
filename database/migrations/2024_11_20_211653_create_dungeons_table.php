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
        Schema::create('dungeons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('expansion')->default('Classic');
            $table->json('difficulties')->nullable();
            $table->json('max_players')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dungeons');
    }
};
