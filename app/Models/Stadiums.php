<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadiums extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'lat',
        'lng',
        'image'
    ];
}
