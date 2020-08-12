<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'name_position',
        'descrtion_position',
        'level_position'
    ];
}
