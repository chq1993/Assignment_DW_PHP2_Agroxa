<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table = 'roles';
  protected $fillable = [
    'id_user',
    'id_position',
    'id_division',
    'status',
    'percentageOfRole',
    'guard_name',
    'start_time',
    'end_time'
  ];

  public function position()
  {
    return $this->belongsTo('positions', 'id_position', 'id'); //(tên bảng, fk, id)
  }
  public function division()
  {
    return $this->belongsTo('divisions', 'id_division', 'id'); //(tên bảng, fk, id)
  }
  public function user()
  {
    return $this->belongsTo('user', 'id_user', 'id'); //(tên bảng, fk, id)
  }
}
