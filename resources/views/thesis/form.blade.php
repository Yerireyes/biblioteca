<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('Titulo') }}
            {{ Form::text('title', $document->title, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : 'title'), 'placeholder' => 'Titulo']) }}
            {!! $errors->first('title', '<div class="invalid-feedback">:message</p>') !!}
            <br>

            {{ Form::label('Año') }}
            {{ Form::text('year', $document->year, ['class' => 'form-control' . ($errors->has('year') ? ' is-invalid' : 'year'), 'placeholder' => 'Año']) }}
            {!! $errors->first('year', '<div class="invalid-feedback">:message</p>') !!}
            <br>
            {{ Form::label('Portada') }}
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
            {{ Form::label('Fecha Defensa') }}
            {{ Form::date('defenseDate', $thesis->defenseDate, ['class' => 'form-control' . ($errors->has('defenseDate') ? ' is-invalid' : 'defensePages'), 'placeholder' => '']) }}
            {!! $errors->first('defenseDate', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Archivo') }}
            <input type="file" name="mydocument" class="form-control-file">

            <br>
            @if(Route::currentRouteName()=="theses.create")
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
                            @if($category->id==$thesis->categoryId)
                            <option selected value="{{$category->id}}">{{$category->name}}</option>
                            @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endif
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>