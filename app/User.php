<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class USER extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'user';
    protected $fillable = [
        'username', 'fullname', 'email', 'phone', 'birthday', 'address','user_type', 'status', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //a ơi, mấy đoạn này a giải thích e 1 xíu nhé. e ko hiểu mấy cái gọi móc nối này
    // giờ a đang lấy user hả a, tưc slaf người dánh giá user sẽ là người bàng cấp với bành đơn vị đúng rồi a
    //a ko gọi join tới bảng nào a anh
    public function getUser($positionsName, $divisionName)
    {
        $user = User::select('user.*')
            ->join('positions', 'positions.name_position ', '=', $positionsName)
            ->join('divisions', 'divisions.name_division', '=', $divisionName)
            ->first();
    }

    public function positions(){
        return $this->belongsToMany(Position::class, 'roles');
    }

    public function divisions(){
        return $this->belongsToMany(Division::class, 'roles');
    }

}
