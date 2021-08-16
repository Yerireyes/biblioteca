<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Role;
use Auth;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::paginate();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('language.index', compact('languages','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $languages->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language = new Language();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('language.create', compact('language','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $language = new Language();
        request()->validate(Language::$rules);
        $request->validate([
            'name'=>['unique:languages']
        ]);
        $language->name=$request['name'];
        $language->save();

        // $language = Language::create($request->all());
        Log::guardar($language->id,'Creo un Idioma');
        return redirect()->route('languages.index')
            ->with('success', 'Idioma creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('language.show', compact('language','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Language::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('language.edit', compact('language','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Language $language
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Language $language)
    public function update(Request $request, $id)
    {
        $language = Language::find($id);
        request()->validate(Language::$rules);
        $request->validate([
            'name'=>['unique:languages']
        ]);
        $language->update($request->all());
        Log::guardar($language->id,'Edito un Idioma');
        return redirect()->route('languages.index')
            ->with('success', 'Language updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $language = Language::find($id)->delete();
        Log::guardar($id,'Elimino un Idioma');
        return redirect()->route('languages.index')
            ->with('success', 'Language deleted successfully');
    }
}
