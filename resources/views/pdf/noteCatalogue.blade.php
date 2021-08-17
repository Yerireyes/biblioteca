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
            
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Generar Catalogo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pdf.storeNoteCatalogue') }}" enctype="multipart/form-data">
                            @csrf
                            <h7>Desde</h7>
                            <br>
                            <input type="date" name="fechaDesde" autocomplete="off">
                            <br>
                            <br>
                            <h7>Hasta</h7>
                            <br>
                            <input type="date" name="fechaHasta" autocomplete="off">
                            <br>
                            <br>
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
