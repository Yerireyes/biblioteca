<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Log;
use Auth;
use Image;

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
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('user.index', compact('users','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required','confirmed','min:8'],
        ]);
        $request->validate([
            'username'=>['unique:users'],
            'email'=>['unique:users']
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
        $log=new Log();
        $log->userId=$user->id;
        $log->idMod=$user->id;
        $log->description='Creo un Usuario';
        $log->save();
        return redirect('login');
    }

    public function show($id)
    {
        $user = User::find($id);
        $users=Auth::user();
        $rol=Role::find($users->roleid);
        return view('user.show', compact('user','rol'));
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        Log::guardar($id,'Elimino un Usuario');
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
            Log::guardar(Auth::id(),'Inicio Sesion');
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
        $user2=Auth::user();
        $rol=Role::find($user2->roleid);
        return view('user.edit',compact('user','roles','rol'));
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->roleid=$request['roleid'];
        $user->save();
        Log::guardar($user->id,'Edito el Rol de un Usuario');
        return redirect()->route('users.index')
        ->with('success', 'Rol Cambiado de '.$user->fullName);
    }

    public function profilePicture($userId){
        $user=User::find($userId);
        $profilePicture=$user->profilePicture;
        try{
            return Image::make(public_path().$profilePicture)->response('jpg');
         }catch(Exception $e){
            return Image::make(public_path(). "/imagenes/users/1.jpg")->response('jpg');
         }
    }

    public function editProfile($id){
        $user=User::find($id);
        
        return view('user.profile',compact('user'));
    }
    public function editProfile2($id){
        $user=User::find($id);
        return view('user.profile2',compact('user',));
    }

    public function configuraciones(){
        $user=Auth::user();
        return view('user.config',compact('user'));
    }
    
    public function configuraciones2(){
        $user=Auth::user();
        return view('user.config2',compact('user'));
    }

    public function configuracionesGuardar(Request $request){
        $user=User::find(Auth::id());
        $user->fullName=$request['fullName'];
        $user->username=$request['username'];
        $user->email=$request['email'];
        if($request->hasFile('profilePicture')){
            $profilePicture=$request->profilePicture;
            $image=Image::make($profilePicture);
            $image->resize(300,300);
            $image->save(public_path()."/imagenes/users/$user->id.jpg");
            $user->profilePicture="/imagenes/users/$user->id.jpg";
        }
        $user->save();
        return redirect()->route('user.profile',Auth::id());
    }
    public function configuracionesGuardar2(Request $request){
        $user=User::find(Auth::id());
        $user->fullName=$request['fullName'];
        $user->username=$request['username'];
        $user->email=$request['email'];
        if($request->hasFile('profilePicture')){
            $profilePicture=$request->profilePicture;
            $image=Image::make($profilePicture);
            $image->resize(300,300);
            $image->save(public_path()."/imagenes/users/$user->id.jpg");
            $user->profilePicture="/imagenes/users/$user->id.jpg";
        }
        $user->save();
        return redirect()->route('user.profile2',Auth::id());
    }

    public function password(){
        return view('user.password');
    }
    public function password2(){
        return view('user.password2');
    }

    public function passwordGuardar(Request $request){
        $request['email']=Auth::user()->email;
        $request->validate([
            'oldpassword' => ['required','confirmed','min:8']
        ]);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
           $user=User::find(Auth::id());
           $user->password=bcrypt($request['oldpassword']);
           $user->save();
        }else {
            return redirect()->back()->with('errors','Contraseña Incorrecta');
        }
        return redirect()->route('user.profile',Auth::id());
    }
    public function passwordGuardar2(Request $request){
        $request['email']=Auth::user()->email;
        $request->validate([
            'oldpassword' => ['required','confirmed','min:8']
        ]);
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
           $user=User::find(Auth::id());
           $user->password=bcrypt($request['oldpassword']);
           $user->save();
        }else {
            return redirect()->back()->with('errors','Contraseña Incorrecta');
        }
        return redirect()->route('user.profile2',Auth::id());
    }
}
