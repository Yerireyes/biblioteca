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
        $document->description='1. Números reales y desigualdades 2. Funciones 3. Vectores en el plano 4. Geometría analítica 5. Límites 6. Derivadas 7. Aplicaciones de derivadas 8. Integrales 9. Aplicaciones de las integrales.';
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
        $document->title='Algebra de Baldor';
        $document->coverPage="/imagenes/documents/perrito.jpg";
        $document->uploadDate=Carbon::now();
        $document->downloadCounter=0;
        $document->type='L';
        $document->counterLikes=0;
        $document->counterDislikes=0;
        $document->description='Número y forma son los pilares sobre los cuales se ha construido el enorme edificio de la Matemática. Sobre aquél se erigieron la Aritmética y el Álgebra; sobre éste, la Geometría y la Trigonometría. En plena Edad Moderna, ambos pilares se unifican en maravillosa simbiosis para sentar la base del análisis. Del número -en su forma concreta y particular- surgió la Aritmética, primera etapa en la historia de la Matemática. Más tarde, cuando el hombre dominó el concepto de número y lo hizó de manera abstracta y general, dio un paso adelante en el desarrollo del pensamiento matemático, así nació el Álgebra.  los griegos han dejado una estela maravillosa de su singular ingenio en casi todas las manifestaciones culturales. De manera que en las formas concretas lograron elaborar un insuperable plástica y en las formas puras nos legaron las corrientes perennes de su filosofía y las bases teóricas de la Matemática ulterior. Nuestra cultura y civilización son una constante recurrencia a lo griego. Por ello, no podemos ignorar la contribución de los pueblos helénicos al desarrollo de la Matemática. El cuerpo de las doctrinas matemáticas que establecieron los griegos tiene sus aristas más sobresalientes en Euclides, Arquímedes y Diáfano.  Con Arquímedes -hombre griego- se inicia la lista de matemáticos modernos. Hierón, rey de Siracusa, ante la amenaza de las tropas romanas a las órdenes de Marcelo, solicita a Arquímedes llevar a cabo la aplicación de esta ciencia. De manera que él diseña y prepara los artefactos de guerra que detienen por tres años al impetuoso general romano. En la guarda se puede observar cómo las enormes piedras de más de un cuarto de tonelada de peso, lanzadas por catapultas, rechazaban a los ejércitos romanos y cómo los espejos ustorios convenientemente dispuestos incendian la poderosa flota. Al caer Megara y verse bloqueado, Siracusa se rinde (212 a. C.). Marcelo, asombrado ante el saber de quien casi lo había puesto en fuga con sus ingeniosidades, requiere su presencia. Ante la negación de Arquímedes de prestar sus servicios al soberbio general vencedor de su Patria, un soldado romano le da muerte con su espada.';
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
