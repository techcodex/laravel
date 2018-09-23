<?php
/**
 * Created by PhpStorm.
 * User: SohaiB
 * Date: 9/23/2018
 * Time: 3:33 AM
 */
namespace App\Repository\LocationRepository;
use App\Repository\LocationRepository\Country;
use Illuminate\Support\Facades\DB;
use App\Repository\LocationRepository\State;
class LocationRepository
{
    public static function get_countries() {
        $countries = Country::select('id','name')
            ->orderby('name','asc')
            ->get();
        return $countries;
    }
    public static function get_states($country_id) {
        $obj_country = new Country();
        $obj_country->id = $country_id;
        $states = $obj_country->states;

        return $states;
    }
    public static function get_cities($state_id) {
        $obj_state = new State();
        $obj_state->id = $state_id;
        $cities = $obj_state->cities;
        return $cities;
    }
}