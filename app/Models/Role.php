<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rol
 *
 * @property $id
 * @property $nombre
 *
 * @property Usuario[] $usuarios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Role extends Model
{
    
    static $rules = [
		'roleName' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    // protected $fillable = ['nombre'];
    protected $fillable = ['roleName'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function usuarios()
    // {
    //     return $this->hasMany('App\Models\Usuario', 'Rolid', 'id');
    // }
    

}
