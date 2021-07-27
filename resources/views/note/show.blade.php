@extends('layouts.app')

@section('template_title')
{{ $note->title ?? 'Show Note' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Apuntes</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('notes.index') }}"> Volver</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <div class="card mb-3 border-dark">
                            <div class="row g-0">
                                <div class="col-md-5">
                                <img src="{{route('cover_Page',$note->documentId)}}" width="100%" height="100%">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$note->title}}</h5>
                                        @foreach($authors as $author)
                                            <span class="badge rounded-pill bg-dark text-white">{{$author->name." ".$author->lastName}}</span>
                                        @endforeach
                                        <br>
                                        <br>
                                        <p class="card-text">{{$note->description}}
                                        </p>
                                        <p class="card-text"><small class="text-muted">{{$note->year}}</small>
                                        </p>
                                        <div class="row justify-content-around">
                                            <a class="btn btn-primary" href="{{$note->mydocument}}" target="_blank">ver documento</a>
                                            <a class="btn btn-primary" href="{{route('documents.download',$note->documentId)}}">descargar documento</a>
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