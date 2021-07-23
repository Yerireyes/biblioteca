<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;

    public function categoryName($superCategory) 
    {
        $category=Category::find($superCategory);
        if ($category){
            return $category->name;
        }

        return 'NA';
    }
    
}
