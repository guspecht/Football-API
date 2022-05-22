<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teams;

class Groups extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'winner',
        'runnerup'
    ];


    public function teams(){
        return $this->belongsTo(Teams::class);
    }
}
