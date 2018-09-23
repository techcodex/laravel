<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepository\UserRepository;
use Illuminate\Support\Facades\Session;
use App\Repository\LocationRepository\LocationRepository;
use App\Repository\UserRepository\Profile;
class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('check_login')->only(['create','show_all_users']);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'page_heading'=>'Add New User',
            'page_title'=>'Add New User',
        ];
        $data['countries'] = LocationRepository::get_countries();
        return view('users.add_user')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $response = [];
        $request->validate([
            'user_name'=>'required|unique:users',
            'email'=>'required',
            'password'=>'required|min:7',
        ]);
        try{
            $user_data = [
                'user_name'=>$request->input('user_name'),
                'email'=>$request->input('email'),
                'password'=>Hash::make($request->input('password')),
            ];
            $user = UserRepository::add_user($user_data);
            $data = $request->all();
            unset($data['user_name']);
            unset($data['email']);
            unset($data['password']);
            $data['user_id'] = $user->id;

            Profile::create($data);

            $response['success'] = true;
            $response['msg'] = "User Added Successfully";
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $response = [];
        try{
            $user = [];
            $user = UserRepository::get_user($id);

            $profile = $user->profile;

            $user['first_name'] = $profile->first_name;
            $user['last_name'] = $profile->last_name;
            $user['contact_no'] = $profile->contact_no;
            $user['middle_name'] = $profile->middle_name;
            $user['address'] = $profile->address;
            $user['profile_image'] = $profile->profile_image;
            $user['date_of_birth'] = $profile->date_of_birth;
            $user['country_id'] = $profile->country_id;
            $user['state_id'] = $profile->state_id;
            $user['city_id'] = $profile->city_id;
            $user['gender'] = $profile->gender;

            $response['success'] = TRUE;
            $response['user'] = $user;
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        print_r($_FILES);
        die;

        $request->validate([
            'user_name'=>'required',
            'email'=>'required',
        ]);
        $response = [];
        try{
            $user_data = [];
            $user_data = $request->all();
            UserRepository::update($user_data,$id);

            unset($user_data['user_name']);
            unset($user_data['email']);

            UserRepository::update_profile($user_data,$id);
            $response['success'] = TRUE;
            $response['msg'] = "User Update Successfully";
        } catch (Exception $ex) {
            $response['error'] = true;
            $response['msg'] = $ex->getMessage();
        }
        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try{
            UserRepository::delete($id);
            Session::put('success',"User Delted Successfully");
            return redirect()->back();

        } catch (Esception $ex) {
            Session::put('error',$ex->getMessage());
            return redirect('user.show_all_users');
        }

    }

    public function show_all_users() {
        $data = [
            'page_title'=>'All Users',
            'page_heading'=>'Show All Users '
        ];
        $users = UserRepository::show_all_user();
        $data['users'] = $users;
        return view('users.show_all_users')->with($data);

    }
    public function login() {
        if(UserRepository::is_logged_in()) {
            Session::put('error',"Please Logout To view this page");
            return redirect('/');
        }
        return view('users.login');
    }
    public function get_login(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:7',
        ]);
        $user_data = [
          'email'=>$request->input('email'),
          'password'=>$request->input('password'),
        ];
        try{
            UserRepository::get_login($user_data);
            return redirect('/');
        } catch (Exception $ex) {
            Session::put('msg',$ex->getMessage());
            return redirect()->back();
        }

    }
    public function logout() {
        UserRepository::logout();
        return redirect()->route('user.login');
    }
}
