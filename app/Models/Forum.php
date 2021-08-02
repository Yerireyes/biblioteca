<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Document;
use App\Models\Category;

class Forum extends Model
{
    
    use HasFactory;

    public function getCategory($documentId){
        $document=Document::find($documentId);
        return $document->categoryId;
    }
    public function getSuperCategory($documentId){
        $document=Document::find($documentId);
        $superCategory=$this->search($document->categoryId);
        return $superCategory;
    }

    public function search($categoryId){
        if ($categoryId>3) {
            $category=Category::find($categoryId);
            $categoryId=$this->search($category->superCategory);
        }
        return $categoryId;
    }
}
