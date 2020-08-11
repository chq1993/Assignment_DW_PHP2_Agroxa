<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'description_question',
        'group_question',
        'kind_question',
        'required_question'
    ];

    public function question_forms()
    {
        return $this->belongsTo(ConfigForm::class, 'id_question');
    }

    public function answer_questions(){
        return $this->hasMany(ConfigQuestion::class, 'id_question');
    }
}
