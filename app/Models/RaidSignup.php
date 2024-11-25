<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RaidSignup extends Model
{
    public function characters()
    {
        return $this->belongsTo(Character::class);  // Angabe der Pivot-Tabelle mit Schwierigkeitsgrad
    }

    public function raidEncounter()
    {
        return $this->belongsTo(RaidEncounter::class);
    }
}
