<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $subject->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre', 'autocomplete'=>'off']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
            <br>
            {{ Form::label('Siglas') }}
            {{ Form::text('acronym', $subject->acronym, ['class' => 'form-control' . ($errors->has('acronym') ? ' is-invalid' : ''), 'placeholder' => 'Siglas', 'autocomplete'=>'off']) }}
            {!! $errors->first('acronym', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Crear</button>
    </div>
</div>