<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Like;
use App\Models\Document;

class Thesis extends Model
{
    use HasFactory;

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

    public function cantidadMeGusta($documentId)
    {
        return Document::find($documentId)->counterLikes;
    }

    public function cantidadNoMeGusta($documentId)
    {
        return Document::find($documentId)->counterDislikes;
    }
}
