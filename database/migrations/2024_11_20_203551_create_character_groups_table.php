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
        Schema::create('character_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('character_groups_characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('character_group_id')->constrained()->onDelete('cascade'); // Fremdschlüssel zu User
            $table->foreignId('character_id')->constrained()->onDelete('cascade'); // Fremdschlüssel zu User
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_groups');
    }
};
