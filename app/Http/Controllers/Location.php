<?php

namespace App\Http\Controllers;

use App\Repository\LocationRepository\State;
use Illuminate\Http\Request;
use App\Repository\LocationRepository\LocationRepository;
use Exception;
class Location extends Controller
{
    //
    public function get_states(Request $request) {

        $response = [];
        $country_id = $request->input('id');
        if(empty($country_id)) {
            $response['error'] = true;
            $response['msg'] = "Missing Country ID";
            return $response;
        }
        try{
            $states = LocationRepository::get_states($country_id);
            $response['success'] = true;
            $response['states'] = $states;
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
        }
        return $response;

    }
    public static function get_cities(Request $request) {
        $response = [];
        $state_id = $request->input('id');
        if(empty($state_id)) {
            $response['error'] =true;
            $response['msg'] = "Missing State ID";
            return $response;
        }
        try{
            $cities = LocationRepository::get_cities($state_id);
            $response['success'] = true;
            $response['cities'] = $cities;
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
        }
        return $response;

    }
}
