<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Management;
use App\Models\Document;
use Auth;

class Note extends Model
{
    use HasFactory;

    public function managementName($managementId){
        return Management::find($managementId)->name;
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

    public function cantidadMeGusta($documentId)
    {
        return Document::find($documentId)->counterLikes;
    }

    public function cantidadNoMeGusta($documentId)
    {
        return Document::find($documentId)->counterDislikes;
    }
}
