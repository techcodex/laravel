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
        $user = User::find($id)->first();
        return $user;
    }
    public static function update($user_data) {
        $user = User::find($user_data['id']);
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
}