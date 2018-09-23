<?php

namespace App\Repository\LocationRepository
;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function states() {
        return $this->hasMany('App\Repository\LocationRepository\State')->orderBy('name','asc');
    }
    public function cities() {
        return $this->hasManyThrough('App\Repository\LocationRepository\State','App\Repository\LocationRepository\City');
    }

    public function profile() {
        return $this->hasOne('App\Repository\UserRepository\Profile');
    }
}
