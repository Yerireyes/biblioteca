<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Management;

class Note extends Model
{
    use HasFactory;

    public function managementName($managementId){
        return Management::find($managementId)->name;
    }
}
