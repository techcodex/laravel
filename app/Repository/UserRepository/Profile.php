<?php

namespace App\Repository\UserRepository;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $fillable = [
        'user_id','first_name','last_name','middle_name','contact_no','gender','address','profile_image','date_of_birth','country_id',
        'state_id','city_id',
    ];

    public function user() {
        return $this->belongsTo('App\Repository\UserRepository\User');
    }
    public function country() {
        return $this->belongsTo('App\Repository\LocationRepository\Country');
    }
    public function state() {
        return $this->belongsTo('App\Repository\LocationRepository\State');
    }
    public function city() {
        return $this->belongsTo('App\Repository\LocationRepository\City');
    }
}
