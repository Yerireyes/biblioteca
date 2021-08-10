<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Log extends Model
{
    use HasFactory;

    public static function guardar($id, $description){
        $log=new Log();
        $log->userId=Auth::id();
        $log->idMod=$id;
        $log->description=$description;
        $log->save();
    }
}
