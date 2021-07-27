<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuthorsDocuments;
use App\Models\Book;
use App\Models\Document;
use Carbon\Carbon;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $document = new Document();
        $document->year=1998;
        $document->title='Chungara';
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type='L';
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description='Uno de los mejores libros de soluciones de ejercicios';
        $document->pages=57;
        $document->categoryId=7;
        $document->mydocument="/storage/documents/default.pdf";
        $document->save();
        $book = new Book();
        $book->ISBN=1234567;
        $book->edition=3;
        $book->publicationYear=2021;
        $book->documentId=$document->id;
        $book->languageId=1;
        $book->save();
        $authorsDocuments=new AuthorsDocuments();
        $authorsDocuments->authorId=2;
        $authorsDocuments->documentId=$document->id;
        $authorsDocuments->save();

        $document = new Document();
        $document->year=1998;
        $document->title='Ellian';
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type='L';
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description='Yo era un niño feliz y tranquilo hasta que conoci a la señorita pamela ivarnegaray alias comedia, no paraba de hincharme las bolas todo el rato con que escuche sus rolitas malardas disque me harian abrir los ojos';
        $document->pages=57;
        $document->categoryId=7;
        $document->mydocument="/storage/documents/default.pdf";
        $document->save();
        $book = new Book();
        $book->ISBN=1234567;
        $book->edition=3;
        $book->publicationYear=2021;
        $book->documentId=$document->id;
        $book->languageId=1;
        $book->save();
        $authorsDocuments=new AuthorsDocuments();
        $authorsDocuments->authorId=2;
        $authorsDocuments->documentId=$document->id;
        $authorsDocuments->save();
    }
}
