<?php

namespace App\Repository\LocationRepository;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    public function country() {
        return $this->belongsTo('App\Repository\LocationRepository\Country');
    }
    public function cities() {
        return $this->hasMany('App\Repository\LocationRepository\City')->orderBy('name','asc');
    }
}
