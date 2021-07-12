<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Gestion') }}
            {{ Form::text('management', $semester->management, ['class' => 'form-control' . ($errors->has('management') ? ' is-invalid' : ''), 'placeholder' => 'Gestion']) }}
            {!! $errors->first('management', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>