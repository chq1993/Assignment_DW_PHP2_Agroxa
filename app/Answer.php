<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'value_answer',
        'label',
    ];

    public function answer_questions()
    {
        return $this->belongsTo(ConfigQuestion::class, 'id_answer');
    }
}
