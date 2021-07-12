@extends('layouts.app')

@section('template_title')
    Editar Semestre
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Semestre</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('semesters.update', $semester->id) }}"  semester="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('semester.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
