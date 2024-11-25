<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RaidEncounter extends Pivot
{
    protected $table = 'raid_encounters';

    public function raid()
    {
        return $this->belongsTo(Raid::class);
    }

     public function raidSignups()
    {
        return $this->hasMany(RaidSignup::class);
    }
}
