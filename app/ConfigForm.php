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

    public function forms(){
        return $this->belongsTo(Form::class, 'id_form');
    }

    public function questions()
    {
        return $this->hasOne(Question::class, 'id_question');
    }

}
