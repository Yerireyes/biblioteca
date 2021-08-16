<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    static $rules = [
		'title' => 'required',
		'year' => 'required',
		'pages' => 'required',
		'mydocument' => 'required',
    ];

    protected $fillable = ['title'];

    public function meGusta($documentId){
      $like=Like::where('documentId',$documentId)->first();
      if ($like) {
        if ($like->like) {
          return true;
        }
      }
      return false;
    }

    public function noMeGusta($documentId){
      $like=Like::where('documentId',$documentId)->first();
      if ($like) {
        if (!$like->like) {
          return true;
        }
      }
      return false;
    }
}


