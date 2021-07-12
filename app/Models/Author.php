<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    static $rules = [
		'name' => 'required',
		'lastName' => 'required',
    ];

    protected $fillable = ['name','lastName'];
}
