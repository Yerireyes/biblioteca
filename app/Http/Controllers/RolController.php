<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Log;
use Illuminate\Http\Request;
use Auth;

/**
 * Class RolController
 * @package App\Http\Controllers
 */
class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('rols.index', compact('roles','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rols = new Role();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('rols.create', compact('rols','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rol=new Role();
        request()->validate(Role::$rules);
        $request->validate([
            'roleName'=>['unique:roles']
        ]);
        $rol->roleName=$request['roleName'];
        $accions="";
        for ($i=1; $i <= 19 ; $i++) { 
            $accions=$accions.$request->input('accions'.$i);
        
        }
        if ($accions=="") {
            return redirect()->back()
            ->with('error', 'Seleccione una opcion');
        }
        $rol->accion=$accions;
        $rol->save();
        Log::guardar($rol->id,'Creo un Rol');
        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rols = Role::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('rols.show', compact('rols','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rols = Role::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('rols.edit', compact('rols','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Role $rol
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Role $rol)
    public function update(Request $request, $id)
    {
        $rol = Role::find($id);
        request()->validate(Role::$rules);
        $rol->roleName=$request['roleName'];
        $accions="";
        for ($i=1; $i <= 19 ; $i++) { 
            $accions=$accions.$request->input('accions'.$i);
        
        }
        if ($accions=="") {
            return redirect()->back()
            ->with('error', 'Seleccione una opcion');
        }
        $rol->accion=$accions;
        $rol->save();
        Log::guardar($rol->id,'Edito un Rol');
        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $rol = Role::find($id)->delete();
        Log::guardar($id,'Elimino un Rol');
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully');
    }
}
