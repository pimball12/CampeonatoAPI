<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Matchup extends Model
{
    use HasFactory;

    protected $fillable = [

        "user_id",
        "championship_id",
        "team_1_id",
        "team_2_id",
        "team_1_goals",
        "team_2_goals",
        "phase"
    ];

    protected $hidden = [

        'user_id',
        'team_1_id',
        'team_2_id',
        'championship_id'
    ];

    public function user(): BelongsTo   {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function championship(): BelongsTo   {

        return $this->belongsTo(Championship::class, 'championship_id');
    }

    public function team_1(): HasOne   {

        return $this->hasOne(Team::class, 'id', 'team_1_id');
    }

    public function team_2(): HasOne   {

        return $this->hasOne(Team::class, 'id', 'team_2_id');
    }
}
