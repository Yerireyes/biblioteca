@extends('layouts.app')

@section('template_title')
    {{ $management->name ?? 'Mostrar Gestion' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Gestion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('managements.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Gestion:</strong>
                            {{ $management->name }}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
