<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'parent_id_division',
        'name_division',
        'description_division',
        'kind_division',
        'division_level'
    ];

    public function user(){
        return $this->belongsToMany(User::class, 'roles');
    }

    public function positions(){
        return $this->belongsToMany(Position::class, 'roles');
    }
}
