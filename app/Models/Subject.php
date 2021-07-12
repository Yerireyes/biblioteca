<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    static $rules = [
		'name' => 'required',
		'acronym' => 'required',
    ];

    protected $fillable = ['name','acronym'];
}
