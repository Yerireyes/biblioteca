<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->string('title');
            $table->string('coverPage');
            $table->datetime('uploadDate');
            $table->integer('downloadCounter');            
            $table->char('type');            
            $table->integer('counterLikes');            
            $table->integer('counterDislikes');            
            $table->text('description');           
            $table->integer('pages');                 
            $table->string('mydocument');                 
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
        Schema::dropIfExists('documents');
    }
}
