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

        Schema::create('dungeon_bosses', function (Blueprint $table) {
            $table->id();
            $table->foreign('dungeon_id')->references('id')->on('dungeons')->onDelete('cascade');
            $table->unsignedBigInteger('dungeon_id'); // Fremdschlüssel für Dungeon
            $table->string('name')->nullable();
            $table->string('difficulty')->nullable();
            $table->integer('max_players')->default(20);
            $table->integer('order')->default(1);
            $table->string('guide_url')->nullable();
            $table->text('info')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dungeon_bosses');
    }
};
