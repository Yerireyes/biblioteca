@extends('layouts.app')

@section('template_title')
    Crear Idioma
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')
                @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                @endif
                @if ($errors->has('Username'))
                        <div class="alert alert-danger">
                            <p>{{$errors->first('Username')}}</p>
                        </div>
                @endif
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Generar Reporte</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pdf.store') }}" enctype="multipart/form-data">
                            @csrf
                            <h7>Nombre de Usuario</h7>
                            <br>
                            <input type="text" name="Username" autocomplete="off">
                            <div class="card-body">
                                <label><input type="checkbox" id="cbox1" value="Si" name="cbox1"> Libros</label><br>
                                <label><input type="checkbox" id="cbox2" value="Si" name="cbox2"> Apuntes</label><br>
                                <label><input type="checkbox" id="cbox3" value="Si" name="cbox3"> Tesis</label><br>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">Generar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
