<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('edition',30);
            $table->string('ISBN',40);
            $table->integer('publicationYear');
            $table->unsignedBigInteger('documentId');
            $table->foreign('documentId')->references('id')->on('documents');
            $table->unsignedBigInteger('languageId');
            $table->foreign('languageId')->references('id')->on('languages');
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
        Schema::dropIfExists('books');
    }
}
