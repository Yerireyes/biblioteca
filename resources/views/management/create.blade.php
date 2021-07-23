@extends('layouts.app')

@section('template_title')
    Crear Gestion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Gestion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('managements.store') }}"  management="form" enctype="multipart/form-data">
                            @csrf

                            @include('management.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
