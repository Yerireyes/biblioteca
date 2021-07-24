<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Document;
use App\Models\Language;
use App\Models\BooksEditorials;
use App\Models\Editorial;
use Carbon\Carbon;
use DB;
use Image;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::
           join('documents', 'books.documentId', '=', 'documents.id')
            ->join('languages', 'books.languageId', '=', 'languages.id')
            ->select('languages.*','documents.*', 'books.*')
            ->orderBy('books.id','asc')
            ->get();
        return view('book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $book = new Book();
        $document = new Document();
        $languages = Language::all();
        return view('book.create',compact('book','document','languages'));
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
        $document->type=$request['type'];
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description=$request['description'];
        $document->pages=$request['pages'];
        $path = $request->file('mydocument')->store('public/documents');
        $pieces = explode("/", $path);
        $document->mydocument="/storage/documents/".$pieces[2];
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
        $book = new Book();
        $book->ISBN=$request['ISBN'];
        $book->edition=$request['edition'];
        $book->publicationYear=$request['publicationYear'];
        $book->documentId=$document->id;
        $book->languageId=$request['languageId'];
        $book->save();
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
        $book = Book::
        where('books.id',$id)
           ->join('documents', 'books.documentId', '=', 'documents.id')
            ->join('languages', 'books.languageId', '=', 'languages.id')
            ->select('languages.*','documents.*', 'books.*')
            ->first();
        return view('book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $document = Document::find($book->documentId);
        $languages = Language::all();
        return view('book.edit',compact('book','document','languages'));
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
        $book = Book::find($id);
        $book->edition=$request['edition'];
        $book->ISBN=$request['ISBN'];
        $book->publicationYear=$request['publicationYear'];
        $book->languageId=$request['languageId'];
        $book->save();
        $document = Document::find($book->documentId);
        // request()->validate(Document::$rules);
        $document->year=$request['year'];
        $document->title=$request['title'];
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
        try{
            if($request->hasFile('mydocumnet')){
                $path = $request->file('mydocument')->store('public/documents');
                $pieces = explode("/", $path);
                $document->mydocument="/storage/documents/".$pieces[2];
            }
        }catch(Exception $e){
            
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
        $book = Book::find($id);
        $document = Document::find($book->documentId);
        $book->delete();
        $document->delete();

        return redirect()->route('books.index')
            ->with('success', 'Libro Eliminado con exito');
    }

    public function editorialsIndex($id){
        // $editorialsAvailable=Editorial::
        // join('books_editorials','editorials.id','books_editorials.editorialId')
        // ->where('books_editorials.bookId',$id)
        $editorialsAvailable=Editorial::all();
        $book=Book::find($id);
        $editorials=BooksEditorials::where('bookId',$id)
        ->join('editorials','books_editorials.editorialId','editorials.id')
        ->get();
        return view('books_editorials.index',compact('editorials','editorialsAvailable','book'));
    }

    public function editorialsCreate(Request $request, $id){
        $booksEditorials=new BooksEditorials();
        $booksEditorials->bookId=$id;
        $booksEditorials->editorialId=$request['editorialId'];
        $existe=BooksEditorials::where([
            ['bookId',$id],
            ['editorialId',$request['editorialId']]
        ])->first();
        if($existe){
            return redirect()->back()->with('error', 'Editorial ya existe');
        }
        $booksEditorials->save();
        return redirect()->back()->with('success', 'Editorial añadida');
    }

    public function editorialsDestroy($bookId, $editorialId)
    {
        BooksEditorials::where([
            ['bookId',$bookId],
            ['editorialId',$editorialId]
        ])->delete();

        return redirect()->back()
            ->with('success', 'Editorial Removida');
    }
}
