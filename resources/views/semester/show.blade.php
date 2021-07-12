@extends('layouts.app')

@section('template_title')
    {{ $semester->management ?? 'Show Semester' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Semestre</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('semesters.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Gestion:</strong>
                            {{ $semester->management }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
