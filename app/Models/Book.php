<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Like;
class Book extends Model
{


    use HasFactory;
    
    public function languageName($languageId){
        return Language::find($languageId)->name;
    }

    public function meGusta($documentId){
        $like=Like::where([
          ['documentId',$documentId],
          ['userId',Auth::id()]
        ])->first();
        if ($like) {
          if ($like->like) {
            return true;
          }
        }
        return false;
      }
  
      public function noMeGusta($documentId){
        $like=Like::where([
          ['documentId',$documentId],
          ['userId',Auth::id()]
        ])->first();
        if ($like) {
          if (!$like->like) {
            return true;
          }
        }
        return false;
      }
}
