<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tvchannels;

class Matches extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'home_team',
        'away_team',
        'home_result',
        'away_result',
        'date',
        'match_type',
        'stadiums_id',
        'groups_id',
    ];

    public function tvchannels(){
        return $this->belongsToMany(
                Tvchannels::class,
                'tvchannels_matches',
                'matches_id',
                'tvchannels_id');
    }
}
