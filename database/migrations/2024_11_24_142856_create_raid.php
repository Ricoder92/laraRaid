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
        Schema::create('raids', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('raid');
            $table->timestamps();
        });

        Schema::create('raid_dungeons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raid_id')->constrained()->onDelete('cascade');
            $table->foreignId('dungeon_id')->constrained()->cascadeOnDelete();
        });

        Schema::create('raid_encounters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raid_id')->constrained()->onDelete('cascade');
            $table->foreignId('dungeon_boss_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('raid_signups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('raid_encounter_id')->constrained()->onDelete('cascade');
            $table->foreignId('character_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raid');
    }
};
