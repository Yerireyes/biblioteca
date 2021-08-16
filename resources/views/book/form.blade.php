<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Titulo') }}
            {{ Form::text('title', $document->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Titulo', 'autocomplete'=>'off']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
            <br>

            {{ Form::label('Año') }}
            {{ Form::text('year', $document->year, ['class' => 'form-control' . ($errors->has('year') ? ' is-invalid' : ''), 'placeholder' => 'Año', 'autocomplete'=>'off']) }}
            {!! $errors->first('year', '<div class="invalid-feedback">:message</p>') !!}
            <br>
            {{ Form::label('Portada') }}
            <input type="file" name="coverPage" class="form-control-file">
            <br>


            {{ Form::label('Descripcion') }}
            {{ Form::textArea('description', $document->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion', 'autocomplete'=>'off']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</p>') !!}
            <br>


            {{ Form::label('Nro Paginas') }}
            {{ Form::text('pages', $document->pages, ['class' => 'form-control' . ($errors->has('pages') ? ' is-invalid' : ''), 'placeholder' => 'Nro Paginas', 'autocomplete'=>'off']) }}
            {!! $errors->first('pages', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Registro ISBN') }}
            {{ Form::text('ISBN', $book->ISBN, ['class' => 'form-control' . ($errors->has('ISBN') ? ' is-invalid' : ''), 'placeholder' => 'RegistroISBN', 'autocomplete'=>'off']) }}
            {!! $errors->first('ISBN', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Edicion') }}
            {{ Form::text('edition', $book->edition, ['class' => 'form-control' . ($errors->has('edition') ? ' is-invalid' : ''), 'placeholder' => 'Edicion', 'autocomplete'=>'off']) }}
            {!! $errors->first('edition', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Año Publicacion') }}
            {{ Form::text('publicationYear', $book->publicationYear, ['class' => 'form-control' . ($errors->has('publicationYear') ? ' is-invalid' : ''), 'placeholder' => 'Año de Publicacion', 'autocomplete'=>'off']) }}
            {!! $errors->first('publicationYear', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Idioma') }}
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

            <br><br>
            @if(Route::currentRouteName()=="books.create")
            {{ Form::label('Autores') }}
            <select id="options" class="form-select" aria-label="Default select example" name="authorId">
                            <option selected disabled>Selecciona un Autor</option>
                            @foreach($authors as $author)
                            <option value="{{$author->id}}">{{$author->name." ".$author->lastName}}</option>
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
            <br>
            <div id="selected-options"></div>
            <input type="hidden" name="authors-id" id="selectedOptionIds" value="">
            <br>
            @endif
            {{ Form::label('Categoria') }}
            <select class="form-select" aria-label="Default select example" name="categoryId">
                            @foreach($categories as $category)
                            @if($category->id==$book->categoryId)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
            <br>
            {{ Form::label('Archivo') }}
            <input type="file" name="mydocument" class="form-control-file">

        </div>
        
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
