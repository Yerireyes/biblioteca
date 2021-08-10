<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Log;

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

        return view('language.index', compact('languages'))
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
        return view('language.create', compact('language'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Language::$rules);
        $language = new Language();
        $language->name=$request['languageName'];
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

        return view('language.show', compact('language'));
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
        
        return view('language.edit', compact('language'));
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
