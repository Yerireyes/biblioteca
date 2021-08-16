<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new Role();
        $rol->roleName="admin";
        $rol->accion="Usuarios, Roles, Libros, Apuntes, Tesis, Editoriales, Autores, Idiomas, Gestiones, Materias, Bitacora, Categorias, EditarComentario, EliminarComentario, EditarForo, EliminarForo, CrearForo, CrearComentario, DescargarDocumento";
        $rol->save();

        $rol = new Role();
        $rol->roleName="user";
        $rol->accion="CrearForo, CrearComentario, DescargarDocumento";
        $rol->save();
    }
}
