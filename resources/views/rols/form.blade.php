<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group"  autocomplete="off">
            {{ Form::label('Nombre') }}
            {{ Form::text('roleName', $rols->roleName, ['class' => 'form-control' . ($errors->has('roleName') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'autocomplete'=>'off']) }}
            {!! $errors->first('roleName', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        
        <h7>Acciones</h7>
        <br><br>
        <div class="form-group">
            <label><input name="accions1" type="checkbox" id="accions1" value="Usuarios,"> Usuarios</label><br>
            <label><input name="accions2" type="checkbox" id="accions2" value="Roles,"> Roles</label><br>
            <label><input name="accions3" type="checkbox" id="accions3" value="Libros,"> Libros</label><br>
            <label><input name="accions4" type="checkbox" id="accions4" value="Apuntes,"> Apuntes</label><br>
            <label><input name="accions5" type="checkbox" id="accions5" value="Tesis,"> Tesis</label><br>
            <label><input name="accions6" type="checkbox" id="accions6" value="Editoriales,"> Editoriales</label><br>
            <label><input name="accions7" type="checkbox" id="accions7" value="Autores,"> Autores</label><br>
            <label><input name="accions8" type="checkbox" id="accions8" value="Idiomas,"> Idiomas</label><br>
            <label><input name="accions9" type="checkbox" id="accions9" value="Gestiones,"> Gestiones</label><br>
            <label><input name="accions10" type="checkbox" id="accions10" value="Materias,"> Materias</label><br>
            <label><input name="accions11" type="checkbox" id="accions11" value="Bitacora,"> Bitacora</label><br>
            <label><input name="accions12" type="checkbox" id="accions12" value="Categorias,"> Categorias</label><br>
            <label><input name="accions13" type="checkbox" id="accions13" value="CrearComentario,"> Crear Comentario</label><br>
            <label><input name="accions14" type="checkbox" id="accions14" value="EditarComentario,"> Editar Comentario</label><br>
            <label><input name="accions15" type="checkbox" id="accions15" value="EliminarComentario,"> Eliminar Comentario</label><br>
            <label><input name="accions16" type="checkbox" id="accions16" value="CrearForo,"> Crear Foro</label><br>
            <label><input name="accions17" type="checkbox" id="accions17" value="EditarForo,"> Editar Foro</label><br>
            <label><input name="accions18" type="checkbox" id="accions18" value="EliminarForo,"> Eliminar Foro</label><br>
            <label><input name="accions19" type="checkbox" id="accions19" value="DescargarDocumento,"> Descargar Documento</label><br>
        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>