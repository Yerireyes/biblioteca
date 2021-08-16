<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Gestion') }}
            {{ Form::text('name', $management->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Gestion', 'autocomplete'=>'off']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}

            
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>