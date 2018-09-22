<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepository\UserRepository;
class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $user = UserRepository::get_user($id);
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
        $request->validate([
            'user_name'=>'required',
            'email'=>'required',
        ]);
        $response = [];
        try{
            $user_data = [];
            $user_data['id'] = $id;
            $user_data['user_name'] = $request->input('user_name');
            $user_data['email'] = $request->input('email');
            UserRepository::update($user_data);
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
}
