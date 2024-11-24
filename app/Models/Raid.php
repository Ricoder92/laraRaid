<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raid extends Model
{
    protected $fillable = ['name', 'dungeon_id'];

    public function bosses()
    {
        return $this->belongsToMany(DungeonBoss::class, 'raid_encounters');  // Angabe der Pivot-Tabelle mit Schwierigkeitsgrad
    }

    public function dungeons()
    {
    return $this->belongsToMany(Dungeon::class, 'raid_dungeons',);
    }

}
