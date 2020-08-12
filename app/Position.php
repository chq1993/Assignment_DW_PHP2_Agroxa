<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Position extends Model
{
    protected $fillable = [
        'name_position',
        'descrtion_position'
    ];

    public function user(){
        return $this->belongsToMany(User::class, 'roles');
    }

    public function divisions(){
        return $this->belongsToMany(Division::class, 'roles');
    }
}
