<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Note;
use App\Models\Document;
use App\Models\Download;
use App\Models\AuthorsDocuments;
use App\Models\Log;
use App\Models\Role;
use Illuminate\Http\Request;
use Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('subject.index', compact('subjects','rol'))
            ->with('i', (request()->input('page', 1) - 1) * $subjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = new Subject();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('subject.create', compact('subject','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Subject::$rules);
        $request->validate([
            'name'=>['unique:subjects'],
            'acronym'=>['unique:subjects']
        ]);
        $subject = new Subject();
        $subject->name=$request['name'];
        $subject->acronym=$request['acronym'];
        $subject->save();

        // $subject = Subject::create($request->all());
        Log::guardar($subject->id,'Creo una Materia');
        return redirect()->route('subjects.index')
            ->with('success', 'Materia creada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('subject.show', compact('subject','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::find($id);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('subject.edit', compact('subject','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Subject $subject
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Subject $subject)
    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        request()->validate(Subject::$rules);

        $subject->update($request->all());
        Log::guardar($subject->id,'Edito una Materia');
        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
       
        $notes = Note::where('subjectId',$id)->get();
        foreach ($notes as $note) {
            $document = Document::find($note->documentId);
            $note->delete();
            AuthorsDocuments::where('documentId',$document->id)->delete();
            Download::where('documentId',$document->id)->delete();
            $document->delete();
        }
        $subject = Subject::find($id)->delete();
        Log::guardar($id,'Elimino una Materia');
        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully');
    }
}
