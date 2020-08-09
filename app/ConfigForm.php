<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigForm extends Model
{
    protected $table = 'question_forms';
    protected $fillable = [
        'id_form',
        'id_question'
    ];
}
