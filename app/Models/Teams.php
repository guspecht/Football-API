<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groups;

class Teams extends Model
{
    use HasFactory;


    protected $table = 'teams';


    protected $fillable = [
        'name',
        'fifaCode',
        'iso2',
        'flag',
        'emoji',
        'emojiString',
        'groups_id'
    ];


    public function groups(){
        $this->hasMany(Groups::class);
    }

}
