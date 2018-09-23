<?php

namespace App\Repository\LocationRepository;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function state() {
        return $this->belongsTo('App\Repository\LocationRepository\State');
    }
    public function country() {
        return $this->belongsTo('App\Repository\LocationRepository\Country');
    }
}
