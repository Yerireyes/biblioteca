<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Note;
use App\Models\Subject;
use App\Models\Management;
use App\Models\Category;
use App\Models\Author;
use App\Models\AuthorsDocuments;
use Carbon\Carbon;
use Exception;
use DB;
use Image;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::
           join('documents', 'notes.documentId', '=', 'documents.id')
            ->join('subjects', 'notes.subjectId', '=', 'subjects.id')
            ->select('subjects.*','documents.*', 'notes.*')
            ->get();
        return view('note.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $note = new Note();
        $document = new Document();
        $subjects = Subject::all();
        $managements = Management::all();
        $categories = Category::all();
        $authors = Author::all();
        return view('note.create',compact('note','document','subjects','managements','categories','authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Document::$rules); 
        // $document = Document::create($request->all());
        $document = new Document();
        $document->year=$request['year'];
        $document->title=$request['title'];
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type="L";
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description=$request['description'];
        $document->pages=$request['pages'];
        $path = $request->file('mydocument')->store('public/documents');
        $pieces = explode("/", $path);
        $document->mydocument="/storage/documents/".$pieces[2];
        $document->categoryId=$request['categoryId'];
        $document->save();
        try{
            if($request->hasFile('coverPage')){
                $coverPage=$request->coverPage;
                $image=Image::make($coverPage);
                $image->resize(300,300);
                $image->save(public_path()."/imagenes/documents/$document->id.jpeg");
                $document->coverPage="/imagenes/documents/$document->id.jpeg";
            }
        }catch(Exception $e){
            throw AuthController::newError("coverPage","Tipo de archivo no soportado.");
        }
        $document->save();
        $note = new Note();
        $note->professor=$request['professor'];
        $note->documentId=$document->id;
        $note->subjectId=$request['subjectid'];
        $note->managementId=$request['managementid'];
        $note->save();
        $authors=$request['authors-id'];
        $pieces = explode("-", $authors);
        for ($i=1; $i < count($pieces) ; $i++) { 
            $authorsDocuments=new AuthorsDocuments();
            $authorsDocuments->authorId=$pieces[$i];
            $authorsDocuments->documentId=$document->id;
            $authorsDocuments->save();
        }
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = DB::table('notes')
        ->where('notes.id',$id)
            ->join('documents', 'notes.documentId', '=', 'documents.id')
            ->select('notes.*', 'documents.*')
            ->first();

        $authors = Author::
            join('authors_documents', 'authors_documents.authorId', '=', 'authors.id')
            ->where('authors_documents.documentId',$note->documentId)
            ->get();
        return view('note.show',compact('note','authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = Note::find($id);
        $document = Document::find($note->documentId);
        $subjects = Subject::all();
        $managements = Management::all();
        $categories = Category::all();
        return view('note.edit',compact('note','document','subjects','managements','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $note = Note::find($id);
        $note->professor=$request['professor'];
        $note->subjectId=$request['subjectid'];
        $note->managementId=$request['managementid'];
        $note->save();
        $document = Document::find($note->documentId);
        // request()->validate(Document::$rules);
        $document->year=$request['year'];
        $document->title=$request['title'];
        $document->description=$request['description'];
        $document->pages=$request['pages'];
        $document->categoryId=$request['categoryId'];
        try{
            if($request->hasFile('coverPage')){
                $coverPage=$request->coverPage;
                $image=Image::make($coverPage);
                $image->resize(300,300);
                $image->save(public_path()."/imagenes/documents/$document->id.jpeg");
                $document->coverPage="/imagenes/documents/$document->id.jpeg";
            }
        }catch(Exception $e){
            throw AuthController::newError("coverPage","Tipo de archivo no soportado.");
        }
        if($request->hasFile('mydocumnet')){
            $path = $request->file('mydocument')->store('public/documents');
            $pieces = explode("/", $path);
            $document->mydocument="/storage/documents/".$pieces[2];
        }
        
        $document->save();
        
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        $document = Document::find($note->documentId);
        $note->delete();
        $document->delete();

        return redirect()->route('theses.index')
            ->with('success', 'Apunte Eliminado con exito');
    }
}
