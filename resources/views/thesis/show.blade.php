@extends('layouts.app')

@section('template_title')
{{ $thesis->title ?? 'Show Documento' }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Documento</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('theses.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <div class="card mb-3 border-dark" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <img src="{{route('cover_Page',$thesis->id)}}" width="100%" height="100%">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$thesis->title}}</h5>
                                        <p class="card-text">{{$thesis->description}}
                                        </p>
                                        <p class="card-text"><small class="text-muted">{{$thesis->year}}</small>
                                        </p>
                                        <a href="{{$thesis->mydocument}}" target="_blank">ver documento</a>
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