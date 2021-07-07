<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->fullName=$request['fullName'];
        $user->username=$request['username'];
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->profilePicture="abc";
        $user->roleid="1";
        $user->save();
        return view("auth.login");
    }
}
