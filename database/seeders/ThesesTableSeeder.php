<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Thesis;
use App\Models\AuthorsDocuments;
use Carbon\Carbon;

class ThesesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        $document = new Document();
        $document->year=2021;
        $document->title="Maquina de Turing";
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type="T";
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->pages=64;
        $document->mydocument="/storage/documents/default.pdf";
        $document->categoryId=18;
        $document->save();
        $thesis = new Thesis();
        $thesis->defenseDate=carbon::now();
        $thesis->documentId=1;
        $thesis->save();


        $authorsDocuments=new AuthorsDocuments();
        $authorsDocuments->documentId=1;
        $authorsDocuments->authorId=1;
        $authorsDocuments->save();

        $document = new Document();
        $document->year=2011;
        $document->title="Intervencion de posos en el campo palmar de la compañia Dong Won Corporation Bolivia";
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type="T";
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->pages=50;
        $document->mydocument="/storage/documents/default.pdf";
        $document->categoryId=18;
        $document->save();
        $thesis = new Thesis();
        $thesis->defenseDate=carbon::now();
        $thesis->documentId=2;
        $thesis->save();

        $authorsDocuments=new AuthorsDocuments();
        $authorsDocuments->documentId=2;
        $authorsDocuments->authorId=1;
        $authorsDocuments->save();

        $authorsDocuments=new AuthorsDocuments();
        $authorsDocuments->documentId=2;
        $authorsDocuments->authorId=2;
        $authorsDocuments->save();
    }
}
