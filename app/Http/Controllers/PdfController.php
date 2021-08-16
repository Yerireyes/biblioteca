<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Download;
use App\Models\Document;
use App\Models\User;
use App\Models\Role;
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