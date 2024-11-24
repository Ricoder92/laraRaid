<?php

use App\Models\Character;
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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Fremdschlüssel zu User
            $table->boolean('is_custom')->default(TRUE);
            $table->string('name');
            $table->integer('level')->nullable();
            $table->enum('race', Character::getAllRaces());
            $table->string('gender')->nullable();
            $table->enum('class', Character::getAllClasses());
            $table->enum('specialization', Character::getAllSpecs());
            $table->enum('faction', Character::getAllFactions());
            $table->enum('region', Character::getAllRegions());
            $table->enum('realm', Character::getAllRealms());
            $table->string('guild')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
