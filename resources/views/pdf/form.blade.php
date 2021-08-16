<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('languageName', $language->languageName, ['class' => 'form-control' . ($errors->has('languageName') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('languageName', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Crear</button>
    </div>
</div>