<?php

namespace App\Http\Controllers;

use App\Models\Management;
use App\Models\Note;
use App\Models\Document;
use App\Models\Download;
use App\Models\AuthorsDocuments;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managements = Management::paginate();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('management.index', compact('managements','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $managements->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $management = new Management();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('management.create', compact('management','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Management::$rules);
        $request->validate([
            'name'=>['unique:managements']
        ]);
        $management = new Management();
        $management->name=$request['name'];
        $management->save();
        

        // $management = Management::create($request->all());
        Log::guardar($management->id,'Creo una Gestion');
        return redirect()->route('managements.index')
            ->with('success', 'Semestre creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $management = Management::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('management.show', compact('management','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $management = Management::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('management.edit', compact('management','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Management $management
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Management $management)
    public function update(Request $request, $id)
    {
        $management = Management::find($id);
        request()->validate(Management::$rules);
        $request->validate([
            'name'=>['unique:managements']
        ]);
        $management->update($request->all());
        Log::guardar($management->id,'Edito una Editorial');
        return redirect()->route('managements.index')
            ->with('success', 'Management updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $notes = Note::where('managementId',$id)->get();
        foreach ($notes as $note) {
            $document = Document::find($note->documentId);
            $note->delete();
            AuthorsDocuments::where('documentId',$document->id)->delete();
            Download::where('documentId',$document->id)->delete();
            $document->delete();
        }
        $management = Management::find($id)->delete();
        Log::guardar($id,'Creo una Editorial');
        return redirect()->route('managements.index')
            ->with('success', 'Management deleted successfully');
    }
}
