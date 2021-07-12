@extends('layouts.app')

@section('template_title')
    Crear Idioma
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Idioma</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('languages.store') }}"  language="form" enctype="multipart/form-data">
                            @csrf

                            @include('language.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
