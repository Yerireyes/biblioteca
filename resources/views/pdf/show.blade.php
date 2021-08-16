@extends('layouts.app')

@section('template_title')
    {{ $language->languageName ?? 'Show Language' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Idioma</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('languages.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $language->languageName }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
