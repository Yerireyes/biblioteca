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
                        <span class="card-title">Generar Reporte</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pdf.storeLog') }}" enctype="multipart/form-data">
                            @csrf
                            <h7>Fecha</h7>
                            <br>
                            <input type="date" name="Fecha" autocomplete="off">
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
