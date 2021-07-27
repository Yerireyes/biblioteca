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

                    <div class="form-group ">
                        <div class="card mb-3 border-dark" >
                            <div class="row g-0">
                                <div class="col-md-5">
                                <img src="{{route('cover_Page',$book->documentId)}}" width="100%" height="100%">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$book->title}}</h5>
                                        @foreach($authors as $author)
                                            <span class="badge rounded-pill bg-dark text-white">{{$author->name." ".$author->lastName}}</span>
                                        @endforeach
                                        <br>
                                        <br>
                                        <p class="card-text">{{$book->description}}
                                        </p>
                                        <p class="card-text"><small class="text-muted">{{$book->year}}</small>
                                        </p>
                                        <p class="card-text">{{$book->languageName($book->languageId)}}
                                        </p>
                                        <div class="row justify-content-around">
                                            <a class="btn btn-primary" href="{{route('documents.show',$book->documentId)}}" target="_blank">ver documento</a>
                                            <a class="btn btn-primary" href="{{route('documents.download',$book->documentId)}}">descargar documento</a>
                                        </div>
                                       
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