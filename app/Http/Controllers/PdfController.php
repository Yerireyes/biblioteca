<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Download;
use App\Models\Document;
use App\Models\User;
use App\Models\Role;
use App\Models\Log;
use App\Models\Book;
use App\Models\Thesis;
use App\Models\Note;
use App\Models\Editorial;
use App\Models\BooksEditorials;
use App\Models\AuthorsDocuments;
use App\Models\Author;
use App\Models\Language;
use App\Models\Management;
use App\Models\Subject;
use Auth;

class PdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.create',compact('rol'));
    }
    public function indexLog()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.log',compact('rol'));
    }
    public function indexBookCatalogue()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.bookCatalogue',compact('rol'));
    }
    public function indexBookPopular()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.bookPopular',compact('rol'));
    }
    public function indexThesisCatalogue()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.thesisCatalogue',compact('rol'));
    }
    public function indexThesisPopular()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.thesisPopular',compact('rol'));
    }
    public function indexNoteCatalogue()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.noteCatalogue',compact('rol'));
    }
    public function indexNotePopular()
    {
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('pdf.notePopular',compact('rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function storeLog(Request $request)
    {
        if (is_null($request->Fecha)) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $logs = Log::whereDate('created_at',$request->Fecha)->get();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, $height, 'Usuario');
        $fpdf->Cell(40, $height, 'Id Modificado');
        $fpdf->Cell(60, $height, 'Descripcion');
        $fpdf->Cell(40, $height, 'Fecha');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($logs as $log) {
            $fpdf->Cell(40, $height, $log->username($log->userId));
            $fpdf->Cell(40, $height, $log->idMod);
            $fpdf->Cell(60, $height, $log->description);
            $fpdf->Cell(40, $height, $log->created_at);
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }
    public function storeBookPopular(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, $height, 'Libros');
        $fpdf->Ln();
        $fpdf->Cell(140, $height, 'Titulo');
        $fpdf->Cell(50, $height, 'NroDescargas');
        $fpdf->Ln();
        $books=Book::join('documents','books.documentId','documents.id')        
        ->get();
        $aux=Download::whereDate('downloads.created_at','>=',$request->fechaDesde)
        ->whereDate('downloads.created_at','<=',$request->fechaHasta)
        ->join('books','downloads.documentId','books.documentId')
        ->get();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($books as $book) {
            $downloads=$aux; 
            $count=0;
            $boolean=false;
            foreach ($downloads as $download) {
                if ($book->documentId==$download->documentId) {
                    $count = $count + $download->count;
                    $boolean=true;
                }
            }
            if ($boolean) {
                $fpdf->Cell(140, $height, $book->title);
                $fpdf->Cell(50, $height, $count);
                $fpdf->Ln();
            }
        }
        $fpdf->Output('I');
        exit;
    }

    
    public function storeBookCatalogue(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $books=Book::whereDate('created_at','>=',$request->fechaDesde)
        ->whereDate('created_at','<=',$request->fechaHasta)
        ->get();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(140, $height, 'Libro');
        $fpdf->Cell(60, $height, 'Creado');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($books as $book) {
            $fpdf->Cell(140, $height, Document::find($book->documentId)->title);
            $fpdf->Cell(60, $height, $book->created_at);
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeThesisPopular(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, $height, 'Tesis');
        $fpdf->Ln();
        $fpdf->Cell(140, $height, 'Titulo');
        $fpdf->Cell(50, $height, 'NroDescargas',0,0,'R');
        $fpdf->Ln();
        $theses=Thesis::join('documents','theses.documentId','documents.id')        
        ->get();
        $aux=Download::whereDate('downloads.created_at','>=',$request->fechaDesde)
        ->whereDate('downloads.created_at','<=',$request->fechaHasta)
        ->join('theses','downloads.documentId','theses.documentId')
        ->get();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($theses as $thesis) {
            $downloads=$aux; 
            $count=0;
            $boolean=false;
            foreach ($downloads as $download) {
                if ($thesis->documentId==$download->documentId) {
                    $count = $count + $download->count;
                    $boolean=true;
                }
            }
            if ($boolean) {
                $fpdf->Cell(140, $height, utf8_decode($thesis->title),0,0,'L');
                $fpdf->Cell(50, $height, $count,0,0,'R');
                $fpdf->Ln();
            }
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeThesisCatalogue(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $theses=Thesis::whereDate('created_at','>=',$request->fechaDesde)
        ->whereDate('created_at','<=',$request->fechaHasta)
        ->get();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0,$height, 'Desde: '.$request->fechaDesde);
        $fpdf->Cell(0,$height, 'Hasta: '.$request->fechaHasta,0,0,'R');
        $fpdf->Ln();
        $fpdf->Cell(140, $height, 'Tesis');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($theses as $thesis) {
            $fpdf->Write($height, utf8_decode(Document::find($thesis->documentId)->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }


    public function storeNotePopular(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(0, $height, 'Apuntes');
        $fpdf->Ln();
        $fpdf->Cell(140, $height, 'Titulo');
        $fpdf->Cell(50, $height, 'NroDescargas',0,0,'C');
        $fpdf->Ln();
        $notes=Note::join('documents','notes.documentId','documents.id')        
        ->get();
        $aux=Download::whereDate('downloads.created_at','>=',$request->fechaDesde)
        ->whereDate('downloads.created_at','<=',$request->fechaHasta)
        ->join('notes','downloads.documentId','notes.documentId')
        ->get();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($notes as $note) {
            $downloads=$aux; 
            $count=0;
            $boolean=false;
            foreach ($downloads as $download) {
                if ($note->documentId==$download->documentId) {
                    $count = $count + $download->count;
                    $boolean=true;
                }
            }
            if ($boolean) {
                $fpdf->Cell(140, $height, utf8_decode($note->title));
                $fpdf->Cell(50, $height, $count,0,0,'C');
                $fpdf->Ln();
            }
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeNoteCatalogue(Request $request)
    {
        if ((is_null($request->fechaDesde))  || (is_null($request->fechaHasta))) {
            return redirect()->back()
            ->with('error', 'Seleccione una Fecha');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height=6;
        $notes=Note::whereDate('created_at','>=',$request->fechaDesde)
        ->whereDate('created_at','<=',$request->fechaHasta)
        ->get();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(140, $height, 'Tesis');
        $fpdf->Cell(60, $height, 'Creado');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($notes as $note) {
            $fpdf->Cell(140, $height, utf8_decode(Document::find($note->documentId)->title));
            $fpdf->Cell(60, $height, $note->created_at);
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }


    public function storeRol($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Rol :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, Role::find($id)->roleName);
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Usuarios');
        $users=User::where('roleid',$id)->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($users as $user) {
            $fpdf->Write($height,utf8_decode($user->username));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeEditorial($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(25, $height, 'Editorial :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, Editorial::find($id)->name);
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Libros');
        $editorials=BooksEditorials::where('editorialId',$id)
        ->join('books','books_editorials.bookId','books.id')
        ->join('documents','books.documentId','documents.id')
        ->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($editorials as $editorial) {
            $fpdf->Write($height,utf8_decode($editorial->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }
    public function storeAuthor($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Autor :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, Author::find($id)->name.' '.Author::find($id)->lastName);
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Libros');
        $authors=AuthorsDocuments::where('authorId',$id)
        ->join('documents','authors_documents.documentId','documents.id')
        ->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($authors as $author) {
            $fpdf->Write($height,utf8_decode($author->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeLanguage($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20, $height, 'Idioma :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, utf8_decode(Language::find($id)->name));
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Libros');
        $books=Book::where('languageId',$id)
        ->join('documents','books.documentId','documents.id')
        ->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($books as $book) {
            $fpdf->Write($height,utf8_decode($book->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeManagement($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20, $height, 'Gestion :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, utf8_decode(Management::find($id)->name));
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Apuntes');
        $notes=Note::where('managementId',$id)
        ->join('documents','notes.documentId','documents.id')
        ->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($notes as $note) {
            $fpdf->Write($height,utf8_decode($note->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }

    public function storeSubject($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20, $height, 'Materia :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, utf8_decode(Subject::find($id)->name));
        $fpdf->Ln();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(15, $height, 'Apuntes');
        $notes=Note::where('subjectId',$id)
        ->join('documents','notes.documentId','documents.id')
        ->get();
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($notes as $note) {
            $fpdf->Write($height,utf8_decode($note->title));
            $fpdf->Ln();
        }
        $fpdf->Output('I');
        exit;
    }


    public function store(Request $request)
    {
        $request->validate([
            'Username' => 'required|exists:users,username'
        ], [
            'Username.required' => 'Introduzca un Usuario',
            'Username.exists' => 'El usuario no ha sido encontrado',
        ]);
        if (is_null($request->cbox1)&&is_null($request->cbox2)&&is_null($request->cbox3)) {
            return redirect()->back()
            ->with('error', 'Seleccione una opcion');
        }
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $id =User::where('username',$request->Username)->first()->id;
        $downloads = Download::where('userId', $id)->get();
        $user = User::find($id);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20, $height, 'Usuario :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, utf8_decode($user->username));
        $fpdf->Ln();
        if (!is_null($request->cbox1)) {
            $books = [];
            foreach ($downloads as $download) {
                $books[] = Document::where([
                    ['id', $download->documentId],
                    ['type', 'L']
                ])->first();
            }
            $fpdf->Cell(0, $height);
            $fpdf->Ln();
            $fpdf->SetFont('Arial', 'B', 12);
            $fpdf->Cell(40, $height, 'Libros');
            $fpdf->Ln();
            $fpdf->SetFont('Arial', '', 12);
            $c = 1;
            foreach ($books as $book) {
                if (!is_null($book)) {
                    $fpdf->Write($height, $c . '.- ' . utf8_decode($book->title));
                    $fpdf->Ln();
                    $c++;
                }
            }
        }
        if (!is_null($request->cbox2)) {
            $notes = [];
            foreach ($downloads as $download) {
                $notes[] = Document::where([
                    ['id', $download->documentId],
                    ['type', 'A']
                ])->first();
            }
            $fpdf->Cell(0, $height);
            $fpdf->Ln();
            $fpdf->SetFont('Arial', 'B', 12);
            $fpdf->Cell(40, $height, 'Apuntes');
            $fpdf->Ln();
            $fpdf->SetFont('Arial', '', 12);
            $c = 1;
            foreach ($notes as $note) {
                if (!is_null($note)) {
                    $fpdf->Write($height, $c . '.- ' . utf8_decode($note->title));
                    $fpdf->Ln();
                    $c++;
                }
            }
        }
        if (!is_null($request->cbox3)) {
            $theses = [];
            foreach ($downloads as $download) {
                $theses[] = Document::where([
                    ['id', $download->documentId],
                    ['type', 'T']
                ])->first();
            }
            $fpdf->Cell(0, $height);
            $fpdf->Ln();
            $fpdf->SetFont('Arial', 'B', 12);
            $fpdf->Cell(40, $height, 'Tesis');
            $fpdf->Ln();
            $fpdf->SetFont('Arial', '', 12);
            $c = 1;
            foreach ($theses as $thesis) {
                if (!is_null($thesis)) {
                    $fpdf->Write( $height, $c . '.- ' . utf8_decode($thesis->title));
                    $fpdf->Ln();
                    $c++;
                }
            }
        }
        $fpdf->Output('I');
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fpdf = new Fpdf();
        $fpdf->AddPage();
        $height = 6;
        $downloads = Download::where('userId', $id)->get();
        $user = User::find($id);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(20, $height, 'Usuario :');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->Cell(0, $height, utf8_decode($user->username));
        $fpdf->Ln();
        $books = [];
        foreach ($downloads as $download) {
            $books[] = Document::where([
                ['id', $download->documentId],
                ['type', 'L']
            ])->first();
        }
        $fpdf->Cell(0, $height);
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, $height, 'Libros');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($books as $book) {
            if (!is_null($book)) {
                $fpdf->Cell(40, $height, utf8_decode($book->title));
                $fpdf->Ln();
            }
        }
        $notes = [];
        foreach ($downloads as $download) {
            $notes[] = Document::where([
                ['id', $download->documentId],
                ['type', 'A']
            ])->first();
        }
        $fpdf->Cell(0, $height);
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, $height, 'Apuntes');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($notes as $note) {
            if (!is_null($note)) {
                $fpdf->Cell(40, $height, utf8_decode($note->title));
                $fpdf->Ln();
            }
        }
        $theses = [];
        foreach ($downloads as $download) {
            $theses[] = Document::where([
                ['id', $download->documentId],
                ['type', 'T']
            ])->first();
        }
        $fpdf->Cell(0, $height);
        $fpdf->Ln();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell(40, $height, 'Tesis');
        $fpdf->Ln();
        $fpdf->SetFont('Arial', '', 12);
        foreach ($theses as $thesis) {
            if (!is_null($thesis)) {
                $fpdf->Cell(40, $height, utf8_decode($thesis->title));
                $fpdf->Ln();
            }
        }
        $fpdf->Output('I');
        exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}