@extends('layouts.app')

@section('template_title')
    Editar Idioma
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Idioma</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('languages.update', $language->id) }}"  language="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('language.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
