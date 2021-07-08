<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('roleName', $rol->roleName, ['class' => 'form-control' . ($errors->has('roleName') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('roleName', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>