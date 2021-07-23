<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Auth;

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
        $users = User::paginate();

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','confirmed'],
        ]);
        $user = new User();
        $user->fullName=$request['fullName'];
        $user->username=$request['username'];
        $user->email=$request['email'];
        $user->password=bcrypt($request['password']);
        $user->profilePicture="abc";
        $user->roleid="2";
        $user->save();
        // return view("auth.login");
        return redirect('login');
    }

    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $roleid = Auth::user()->roleid;
            if ($roleid == 1) {
                return redirect()->route('home'); 
            }

            return redirect()->route('home2');
        }
        return back()->withErrors([
            'email' => 'Credenciales incorrectos.',
        ]);
    }

    public function edit($id){
        $user = User::find($id);
        $roles = Role::all();
        return view('user.edit',compact('user','roles'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->roleid=$request['roleid'];
        $user->save();
        return redirect()->route('users.index')
        ->with('success', 'Rol Cambiado de '.$user->fullName);
    }
}
