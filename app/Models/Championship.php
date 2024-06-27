<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = [

        "user_id",
        "name"
    ];

    protected $hidden = [

        "user_id"
    ];

    public function user(): BelongsTo   {

        return $this->belongsTo(User::class, 'user_id');
    }

    public function matchups(): HasMany {

        return $this->hasMany(Matchup::class, 'championship_id');
    }
}
