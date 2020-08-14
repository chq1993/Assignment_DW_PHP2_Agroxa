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
    //test
    // public static function getQuestion($idQuestion){
    //     // thằng laravel này nó sao ý a... em đặt trung với class nó tạo ra bảng thì nó thêm "s" phía sau
    //    // umk
    //     $question = Question::select('questions.question')
    //     //đợi a, sai
    //         ->join('question_forms','question_forms.id_question','=','questions.id')
    //         ->where('questions.id',$idQuestion)
    //         ->first();
    // }
}
