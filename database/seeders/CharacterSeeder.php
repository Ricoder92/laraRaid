<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    public function run(): void
    {
        Character::factory()->count(50)->create();
    }
}