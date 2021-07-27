<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('authorId');
            $table->foreign('authorId')->references('id')->on('authors');
            $table->unsignedBigInteger('documentId');
            $table->foreign('documentId')->references('id')->on('documents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_documents');
    }
}
