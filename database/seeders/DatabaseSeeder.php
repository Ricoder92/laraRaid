<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dungeon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Raidlead',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            DungeonSeeder::class,
            CharacterSeeder::class,
        ]);

    }
}
