<?php
/**
 * Created by PhpStorm.
 * User: SohaiB
 * Date: 9/20/2018
 * Time: 1:22 AM
 */

namespace App\Repository\UserRepository;


use Exception;

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
}