<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matches;

class Tvchannels extends Model
{
    use HasFactory;


    protected $table = 'tvchannels';

    protected $fillable = [
        'name',
        'icon',
        'country',
        'iso2',
        'lang'
    ];

    public function matches(){

        return $this->belongsToMany(
                Matches::class,
                'tvchannels_matches',
                'tvchannels_id',
                'matches_id');
    }

}
