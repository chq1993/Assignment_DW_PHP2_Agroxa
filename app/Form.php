<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name_form',
        'description_form'
    ];

    public function question_forms(){
        return $this->hasMany(ConfigForm::class, 'id_form');
    }
}
