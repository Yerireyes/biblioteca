<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookseditorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_editorials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookId');
            $table->foreign('bookId')->references('id')->on('books');
            $table->unsignedBigInteger('editorialId');
            $table->foreign('editorialId')->references('id')->on('editorials');
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
        Schema::dropIfExists('bookseditorials');
    }
}
