<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchup extends Model
{
    use HasFactory;

    protected $fillable = [

        "championship_id",
        "team_1_id",
        "team_2_id",
        "team_1_goals",
        "team_2_goals",
        "phase"
    ];

    public function championship(): BelongsTo   {

        return $this->belongsTo(Championship::class, 'championship_id');
    }

    public function team_1(): BelongsTo   {

        return $this->belongsTo(User::class, 'team_1_id');
    }

    public function team_2(): BelongsTo   {

        return $this->belongsTo(User::class, 'team_2_id');
    }
}
