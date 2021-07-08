<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        return $request->all();
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
}
