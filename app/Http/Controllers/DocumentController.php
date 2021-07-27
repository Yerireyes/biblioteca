<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Download;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;
use Auth;
use File;
use Illuminate\Support\Facades\Storage;

/**
 * Class DocumentController
 * @package App\Http\Controllers
 */
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::paginate();

        return view('document.index', compact('documents'))
            ->with('i', (request()->input('page', 1) - 1) * $documents->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->downloadCounter=0;
        $document->uploadDate=Carbon::now();

        return view('document.create', compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
        $document->type=$request['type'];
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description=$request['description'];
        $document->pages=$request['pages'];
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

        return redirect()->route('documents.index')
            ->with('success', 'Document created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);

        return view('document.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::find($id);
        

        return view('document.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Document $document
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Document $document)
    public function update(Request $request, $id)
    {
        $document = Document::find($id);
        // request()->validate(Document::$rules);
        $document->year=$request['year'];
        $document->title=$request['title'];
        $document->coverPage=$request['coverPage'];
        $document->type=$request['type'];
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
        $document->save();
        
        // $document->update($request->all());

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $document = Document::find($id)->delete();

        return redirect()->route('documents.index')
            ->with('success', 'Document deleted successfully');
    }

    public function coverPage($documentId){
        $document=Document::find($documentId);
        $coverPage=$document->coverPage;
        try{
            return Image::make(public_path(). $coverPage)->response('jpg');
         }catch(Exception $e){
            return Image::make(public_path(). "/imagenes/documents/1.jpg")->response('jpg');
         }
    }

    public function download($id){
        $document=Document::find($id);
        $document->downloadCounter++;
        $document->save();
        $user=Auth::user();
        $download=Download::where([
            ['userId',$user->id],
            ['documentId',$id]
        ])->first();
        if (!$download){
            $download=new Download();
            $download->userId=$user->id;
            $download->documentId=$id;
            $download->count=0;
        }
        $download->count++;
        $download->save();
        $pieces = explode("/", $document->mydocument);
        $documentPath="/public/".$pieces[2]."/".$pieces[3];
        $pieces=explode(".",$pieces[3]);
        $extension=$pieces[1];
        return Storage::download($documentPath, $document->title.".".$extension);
        
    }

    public function showDocument($id){
        $document=Document::find($id);
        $document->downloadCounter++;
        $document->save();
        $user=Auth::user();
        $download=Download::where([
            ['userId',$user->id],
            ['documentId',$id]
        ])->first();
        if (!$download){
            $download=new Download();
            $download->userId=$user->id;
            $download->documentId=$id;
            $download->count=0;
        }
        
        $download->count++;
        $download->save();
        $pieces = explode("/", $document->mydocument);
        $documentPath="/public/".$pieces[2]."/".$pieces[3];
        $pieces=explode(".",$pieces[3]);
        $extension=$pieces[1];
        return response()->file($documentPath);
        
    }
}
