@extends('layouts.app')

@section('template_title')
    {{ $author->name ?? 'Show Author' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Autor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('authors.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $author->name }}
                        <br>
                        <br>
                            <strong>Apellido:</strong>
                            {{ $author->lastName }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
