<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function scopeIsUser(Builder $builder,$user_id){
        return $builder->where('user_id',$user_id);
    }
}
