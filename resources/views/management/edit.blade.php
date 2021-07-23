@extends('layouts.app')

@section('template_title')
    Editar Gestion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Gestion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('managements.update', $management->id) }}"  management="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('management.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
