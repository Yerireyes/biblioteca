<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;

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

    public function username($userId){
        return User::find($userId)->username;
    }
}
