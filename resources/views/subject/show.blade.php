@extends('layouts.app')

@section('template_title')
    {{ $subject->name ?? 'Show Subject' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Materia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('subjects.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $subject->name }}
                        <br>
                        <br>
                            <strong>Siglas:</strong>
                            {{ $subject->acronym }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
