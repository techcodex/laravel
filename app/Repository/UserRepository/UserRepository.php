<?php
/**
 * Created by PhpStorm.
 * User: SohaiB
 * Date: 9/20/2018
 * Time: 1:22 AM
 */

namespace App\Repository\UserRepository;


use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Repository\UserRepository\Profile;

class UserRepository
{
    public static function add_user($user_data) {
        $user = User::create($user_data);
        return $user;
    }
    public static function show_all_user() {
        $users = User::all();
        return $users;
    }
    public static function get_user($id) {
        $user = User::find($id)->get()->first();
        return $user;
    }
    public static function update($user_data,$id) {
        $user = User::find($id);
        if(count($user) == 0) {
            throw new Exception("Invalid user ID");
        }
        $user->user_name = $user_data['user_name'];
        $user->email = $user_data['email'];
        $user->save();

    }
    public static function delete($id) {
        $user = User::find($id);
        if(count($user) == 0) {
            throw new Exception("User Not Found");
        }
        $user->profile->delete();

        $user->delete();

    }
    public static function get_login($user_data) {
        extract($user_data);
        $user = User::where('email',$email)->get()->first();
        if(!$user) {
            throw new Exception("User Not Found");
        }
        if(!Hash::check($password,$user->password)) {
            throw new Exception("Invalid User Name or Password");
        }
        $data = [];
        $data['user_name'] = $user->user_name;
        $data['email'] = $user->email;
        $data['id'] = $user->id;
//        dd($data);
        Session::put('user_data',$data);
        Session::put("logged_in",true);
    }
    public static function is_logged_in() {
        if(Session::has('user_data')) {
            return true;
        }
        return false;
    }
    public static function logout() {
        Session::forget('user_data');
        Session::forget('logged_in');
        Session::flush();
    }
    public static function update_profile($user_data,$id) {
        $format = explode("/",$user_data['date_of_birth']);
        $new_date = $format[2]."-".$format[0]."-".$format[1];
//        dd($new_date);
        $user = User::find($id);
        $user->profile->first_name = $user_data['first_name'];
        $user->profile->last_name = $user_data['last_name'];
        $user->profile->middle_name = $user_data['middle_name'];
        $user->profile->address = $user_data['address'];
        $user->profile->gender = $user_data['gender'][0];
        $user->profile->contact_no = $user_data['contact_no'];
        $user->profile_date_of_birth = $new_date;
        $user->profile->country_id = $user_data['country_id'];
        $user->profile->state_id = $user_data['state_id'];
        $user->profile->city_id = $user_data['city_id'];
        $user->profile->save();
    }
}