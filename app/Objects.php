<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class objects extends Model
{
    protected $table = 'object';
    protected $fillable = [
        'parent_id', 'object_code','object_url','object_name','description','object_level','status', 'show_menu', 'created_by', 'updated_by'
    ];
}
