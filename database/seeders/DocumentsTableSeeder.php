<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use Carbon\Carbon;

class DocumentsTableSeeder extends Seeder
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
        $document->title="Lenguajes Formales";
        $document->coverPage="/imagenes/documents/1.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=15;
        $document->type="A";
        $document->counterLikes=1;
        $document->counterDislikes=0;
        $document->description="Apunte de la materia Lenguajes Formales";
        $document->pages=64;
        $document->save();
    }
}