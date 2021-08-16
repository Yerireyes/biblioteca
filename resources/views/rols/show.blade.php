@extends('layouts.app')

@section('template_title')
    {{ $rol->name ?? 'Show Rol' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Rol</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $rols->roleName }}
                            <br>
                            <strong>Acciones:</strong>
                            {{ $rols->accion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
