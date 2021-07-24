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

            <input type="file" name="coverPage" class="form-control-file">
            <br>


            {{ Form::label('Descripcion') }}
            {{ Form::text('description', $document->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : 'description'), 'placeholder' => 'Descripcion']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
            <br>


            {{ Form::label('Nro Paginas') }}
            {{ Form::text('pages', $document->pages, ['class' => 'form-control' . ($errors->has('pages') ? ' is-invalid' : 'pages'), 'placeholder' => 'Nro Paginas']) }}
            {!! $errors->first('pages', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Registro ISBN') }}
            {{ Form::text('ISBN', $book->ISBN, ['class' => 'form-control' . ($errors->has('ISBN') ? ' is-invalid' : 'ISBN'), 'placeholder' => 'RegistroISBN']) }}
            {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Edicion') }}
            {{ Form::text('edition', $book->edition, ['class' => 'form-control' . ($errors->has('edition') ? ' is-invalid' : 'edition'), 'placeholder' => 'Edicion']) }}
            {!! $errors->first('edition', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Año Publicacion') }}
            {{ Form::text('publicationYear', $book->publicationYear, ['class' => 'form-control' . ($errors->has('publicationYear') ? ' is-invalid' : 'publicationYear'), 'placeholder' => 'Año de Publicacion']) }}
            {!! $errors->first('publicationYear', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            <select class="form-select" aria-label="Default select example" name="languageId">
                            @foreach($languages as $language)
                            @if($language->id==$book->languageId)
                            <option selected value="{{$language->id}}">{{$language->name}}</option>
                            @else
                            <option value="{{$language->id}}">{{$language->name}}</option>
                            @endif
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
            <br>
            <input type="file" name="mydocument" class="form-control-file">

        </div>
        
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>