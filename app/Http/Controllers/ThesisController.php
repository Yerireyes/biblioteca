<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thesis;
use App\Models\Document;
use App\Models\Category;
use App\Models\Author;
use App\Models\AuthorsDocuments;
use App\Models\Download;
use App\Models\Log;
use Carbon\Carbon;
use DB;
use Image;

class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theses = DB::table('theses')
            ->join('documents', 'theses.documentId', '=', 'documents.id')
            
            ->select('documents.*', 'theses.*')
            ->get();
        return view('thesis.index',compact('theses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $thesis = new Thesis();
        $document = new Document();
        $categories = Category::all();
        $authors = Author::all();
        return view('thesis.create',compact('thesis','document','categories','authors'));
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
        $thesis = new Thesis();
        $thesis->defenseDate=$request['defenseDate'];
        $thesis->documentId=$document->id;
        $thesis->save();
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
        $thesis = DB::table('theses')
        ->where('theses.id',$id)
            ->join('documents', 'theses.documentId', '=', 'documents.id')
            ->select('theses.*', 'documents.*')
            ->first();

        $authors = Author::
            join('authors_documents', 'authors_documents.authorId', '=', 'authors.id')
            ->where('authors_documents.documentId',$thesis->documentId)
            ->get();
        return view('thesis.show',compact('thesis','authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesis = Thesis::find($id);
        $document = Document::find($thesis->documentId);
        $categories = Category::where('superCategory','3')->get();
        return view('thesis.edit',compact('thesis','document','categories'));
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
        $thesis = Thesis::find($id);
        $thesis->defenseDate=$request['defenseDate'];
        $thesis->save();
        $document = Document::find($thesis->documentId);
        // request()->validate(Document::$rules);
        $document->year=$request['year'];
        $document->title=$request['title'];
        $document->description=$request['description'];
        $document->pages=$request['pages'];
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
        if($request->hasFile('mydocument')){
            $path = $request->file('mydocument')->store('public/documents');
            $pieces = explode("/", $path);
            $document->mydocument="/storage/documents/".$pieces[2];
        }
        $document->categoryId=$request['categoryId'];
        $document->save();
        Log::guardar($thesis->id,'Edito una Tesis');
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
        $thesis = Thesis::find($id);
        $document = Document::find($thesis->documentId);
        Download::where("documentId", $thesis->documentId)->delete();
        AuthorsDocuments::where("documentId", $thesis->documentId)->delete();
        $thesis->delete();
        $document->delete();
        Log::guardar($id,'Elimino una Tesis');
        return redirect()->route('theses.index')
            ->with('success', 'Tesis Eliminada con exito');
    }
}
