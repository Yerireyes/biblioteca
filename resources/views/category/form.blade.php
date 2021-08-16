<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $category->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' :''), 'placeholder' => 'Nombre', 'autocomplete'=>'off']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}

                <select class="form-select" aria-label="Default select example" name="superCategory">
                    
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach

                    <!-- <option selected>Open this select menu</option> -->
                </select>
            </div>


        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>