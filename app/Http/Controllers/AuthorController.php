<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorsDocuments;
use App\Models\Log;
use Illuminate\Http\Request;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::paginate();

        return view('author.index', compact('authors'))
            ->with('i', (request()->input('page', 1) - 1) * $authors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = new Author();
        return view('author.create', compact('author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Author::$rules);
        $author = new Author();
        $author->name=$request['name'];
        $author->lastName=$request['lastName'];
        $author->save();

        // $author = Author::create($request->all());
        Log::guardar($author->id,'Creo un Autor');
        return redirect()->route('authors.index')
            ->with('success', 'Autor creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::find($id);

        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);

        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Author $author
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Author $author)
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        request()->validate(Author::$rules);

        $author->update($request->all());
        Log::guardar($author->id,'Edito un Autor');
        return redirect()->route('authors.index')
            ->with('success', 'Author updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        
        $authorsDocuments=AuthorsDocuments::where('authorId',$id)->first();
        if ($authorsDocuments) {
            return redirect()->back()
            ->with('error', 'No se puede eliminar el Autor porque existe un documento con este Autor');
        }
        $author = Author::find($id)->delete();
        Log::guardar($id,'Elimino un Autor');
        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully');
    }
}
