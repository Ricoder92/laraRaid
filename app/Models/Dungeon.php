<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dungeon extends Model
{
    protected $fillable = ['name', 'difficulties', 'max_players', 'description'];

    protected $casts = [
        'difficulties' => 'array',  // Wandelt JSON-Daten automatisch in ein Array um
        'max_players' => 'array',    // Wandelt JSON-Daten automatisch in ein Array um
    ];

    public function dungeonBosses()
    {
        return $this->hasMany(DungeonBoss::class);
    }

    public function raids()
    {
        return $this->belongsToMany(Raid::class, 'dungeon_raid')->withTimestamps();
    }

}
