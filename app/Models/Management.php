<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;
    public $table="managements";
    static $rules = [
		'name' => 'required',
    ];

    protected $fillable = ['name'];
}
