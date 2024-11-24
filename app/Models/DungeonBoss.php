<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DungeonBoss extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'dungeon_id', 'difficulty', 'max_players'];

    public function dungeon()
    {
        return $this->belongsTo(Dungeon::class);
    }

    public function raids()
    {
        return $this->belongsToMany(Raid::class, 'raid_bosses')
                    ->withPivot('difficulty')
                    ->withTimestamps();
    }
}
