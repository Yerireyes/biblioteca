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
            {{ Form::label('Docente') }}
            {{ Form::text('professor', $note->professor, ['class' => 'form-control' . ($errors->has('professor') ? ' is-invalid' : ''), 'placeholder' => 'Docente', 'autocomplete'=>'off']) }}
            {!! $errors->first('professor', '<div class="invalid-feedback">:message</p>') !!}

            <br>
            {{ Form::label('Materia') }}
            <select class="form-select" aria-label="Default select example" name="subjectid">
                            @foreach($subjects as $subject)
                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
            <br>
            {{ Form::label('Archivo') }}
            <input type="file" name="mydocument" class="form-control-file">

            <br>
            {{ Form::label('Gestion') }}
            <select class="form-select" aria-label="Default select example" name="managementid">
                            @foreach($managements as $management)
                            <option value="{{$management->id}}">{{$management->name}}</option>
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
            <br>
            @if(Route::currentRouteName()=="notes.create")
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
                            @if($category->id==$note->categoryId)
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