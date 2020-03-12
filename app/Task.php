<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function like()
    {
        return $this->hasMany('App\Like');
    }

    // const STATUS = [
    //     1 => [ 'label' => '未着手' ],
    //     2 => [ 'label' => '着手中' ],
    //     3 => [ 'label' => '完了' ],
    // ];

    public function getStatusLabelAttribute()
    {
        $status = $this->attributes['status'];

        if(!isset(self::STATUS[$status])){
            return '';
        }

        return self::STATUS[$status]['label'];
    }
}
