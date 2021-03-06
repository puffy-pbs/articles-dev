<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const ADMINISTRATOR = 1;
    public const AUTHOR = 2;

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
