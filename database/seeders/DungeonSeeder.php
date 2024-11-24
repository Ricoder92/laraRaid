<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dungeon;
use App\Models\DungeonBoss;

class DungeonSeeder extends Seeder
{
    public function run()
    {
        $raids = [
            'Classic' => [
                'Molten Core' => [
                    'difficulties' => [
                        'normal' => 40,
                        'heroic' => 40,
                        'mythic' => 20,
                    ],
                    'bosses' => [
                        'Lucifron', 'Magmadar', 'Gehennas', 'Garr', 'Baron Geddon', 'Shazzrah', 
                        'Sulfuron Harbinger', 'Golemagg the Incinerator', 'Majordomo Executus', 'Ragnaros',
                    ],
                ],
                'Onyxia\'s Lair' => [
                    'difficulties' => [
                        'normal' => 40,
                    ],
                    'bosses' => [
                        'Onyxia',
                    ],
                ],
            ],
            'Burning Crusade' => [
                // Weitere Raids hier hinzufügen...
            ],
            'Shadowlands' => [
                'Castle Nathria' => [
                    'difficulties' => [
                        'normal' => 30,
                        'heroic' => 30,
                        'mythic' => 20,
                    ],
                    'bosses' => [
                        'Shriekwing', 'Huntsman Altimor', 'Artificer Xy\'mox', 'Sludgefist', 'Stone Legion Generals',
                        'Sire Denathrius',
                    ],
                ],
                // Weitere Raids hier hinzufügen...
            ],
        ];

        // Durch die Erweiterungen und Raids iterieren
        foreach ($raids as $expansion => $raidList) {
            foreach ($raidList as $dungeonName => $raid) {
                // Speichern des Dungeons
                $dungeon = Dungeon::create([
                    'name' => $dungeonName,
                    'difficulties' => array_keys($raid['difficulties']), // Die Schwierigkeitsschlüssel
                    'max_players' => $raid['difficulties'], // Die Schwierigkeitsschlüssel
                ]);

                // Für jeden Boss in diesem Dungeon werden Einträge erstellt
                foreach ($raid['bosses'] as $bossName) {
                    foreach ($raid['difficulties'] as $difficulty => $maxPlayersForDifficulty) {
                        DungeonBoss::create([
                            'name' => $bossName,
                            'dungeon_id' => $dungeon->id,
                            'difficulty' => $difficulty,
                            'max_players' => $maxPlayersForDifficulty,
                        ]);
                    }
                }
            }
        }
    }
}
