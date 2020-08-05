<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name_plan',
        'description_plan',
        'start_date',
        'end_date',
        'begin_rate',
        'finish_rate'
    ];
}
