@extends('layouts.app')

@section('template_title')
{{ $book->title ?? 'Show book' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Libros</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('books.index') }}"> Volver</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <div class="card mb-3 border-dark" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <img src="{{route('cover_Page',$book->id)}}" width="100%" height="100%">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$book->title}}</h5>
                                        <p class="card-text">{{$book->description}}
                                        </p>
                                        <p class="card-text"><small class="text-muted">{{$book->year}}</small>
                                        </p>
                                        <a href="{{$book->mydocument}}" target="_blank">ver documento</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection