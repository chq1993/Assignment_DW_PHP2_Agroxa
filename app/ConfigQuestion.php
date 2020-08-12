<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfigQuestion extends Model
{
    protected $table = 'answer_questions';
    protected $fillable = [
        'id_question',
        'id_answer'
    ];

    public function questions(){
        return $this->belongsTo(Question::class, 'id_question');
    }

    public function answers()
    {
        return $this->hasOne(Answer::class, 'id_answer');
    }
}
