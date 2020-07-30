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
}
