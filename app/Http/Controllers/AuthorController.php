<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\AuthorsDocuments;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

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
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('author.index', compact('authors','rol'))
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
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('author.create', compact('author','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new Author();
        request()->validate(Author::$rules);
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
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('author.show', compact('author','rol'));
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
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('author.edit', compact('author','rol'));
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
