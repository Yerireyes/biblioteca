<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('professor');
            $table->unsignedBigInteger('documentId');
            $table->foreign('documentId')->references('id')->on('documents');
            $table->unsignedBigInteger('subjectId');
            $table->foreign('subjectId')->references('id')->on('subjects');
            $table->unsignedBigInteger('managementId');
            $table->foreign('managementId')->references('id')->on('managements');
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
        Schema::dropIfExists('notes');
    }
}
