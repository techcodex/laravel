<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepository\UserRepository;
class Master extends Controller
{
    //
    public function index() {

            $data = [
                'page_title'=>'Admin Panel',
                'page_heading'=>'Admin Panel',
            ];
            return view('app')->with($data);

    }
}
