<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacterGroup extends Model
{
    protected $fillable = [
        'name',
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'character_groups_characters');
    }
}
