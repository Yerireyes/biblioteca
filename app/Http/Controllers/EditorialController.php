<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use App\Models\Log;
use App\Models\BooksEditorials;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editorials = Editorial::paginate();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('editorial.index', compact('editorials','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $editorials->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $editorial = new Editorial();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('editorial.create', compact('editorial','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Editorial::$rules);
        $request->validate([
            'name'=>['unique:editorials']
        ]);

        $editorial = Editorial::create($request->all());
        Log::guardar($editorial->id,'Creo una Editorial');
        return redirect()->route('editorials.index')
            ->with('success', 'Editorial creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editorial = Editorial::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('editorial.show', compact('editorial','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('editorial.edit', compact('editorial','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Editorial $editorial
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Editorial $editorial)
    public function update(Request $request, $id)
    {
        $editorial = Editorial::find($id);
        request()->validate(Editorial::$rules);
        $request->validate([
            'name'=>['unique:editorials']
        ]);
        $editorial->update($request->all());
        Log::guardar($editorial->id,'Edito una Editorial');
        return redirect()->route('editorials.index')
            ->with('success', 'Editorial updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        BooksEditorials::where('editorialId',$id)->delete();
        $editorial = Editorial::find($id)->delete();
        Log::guardar($id,'Elimino una Editorial');
        return redirect()->route('editorials.index')
            ->with('success', 'Editorial deleted successfully');
    }
}
