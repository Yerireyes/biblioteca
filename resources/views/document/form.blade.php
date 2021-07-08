<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Titulo') }}
            {{ Form::text('title', $document->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : 'title'), 'placeholder' => 'Titulo']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
            <br>

            {{ Form::label('Tipo') }}
            {{ Form::text('type', $document->type, ['class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : 'type'), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('type', '<div class="invalid-feedback">:message</p>') !!}
            <br>

            {{ Form::label('Año') }}
            {{ Form::text('year', $document->year, ['class' => 'form-control' . ($errors->has('year') ? ' is-invalid' : 'year'), 'placeholder' => 'Año']) }}
            {!! $errors->first('year', '<div class="invalid-feedback">:message</p>') !!}
            <br>

            {{ Form::label('Portada') }}
            {{ Form::text('coverPage', $document->coverPage, ['class' => 'form-control' . ($errors->has('coverPage') ? ' is-invalid' : 'coverPage'), 'placeholder' => 'Portada']) }}
            {!! $errors->first('coverPage', '<div class="invalid-feedback">:message</p>') !!}
            <br>


            {{ Form::label('Descripcion') }}
            {{ Form::text('description', $document->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : 'description'), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
            <br>


            {{ Form::label('Nro Paginas') }}
            {{ Form::text('pages', $document->pages, ['class' => 'form-control' . ($errors->has('pages') ? ' is-invalid' : 'pages'), 'placeholder' => 'Nro Paginas']) }}
            {!! $errors->first('pages', '<div class="invalid-feedback">:message</p>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>