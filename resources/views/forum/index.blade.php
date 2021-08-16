@extends('home2')

@section('content')
<a href="{{route('books.user',[$forums[0]->getCategory($forums[0]->documentId),$forums[0]->getSuperCategory($forums[0]->documentId)])}}" class="btn btn-outline-secondary ml-3">volver</a>
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-white">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            <h3>{{$document->title}}</h3>
                        </span>
                        @if(str_contains($rol->accion,'CrearForo'))
                        <div class="float-right">
                            <a href="{{ route('forums.create',$document->id) }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                {{ __('Crear Nuevo') }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                
                @foreach($forums as $forum)
                <div class="card my-5">
                    <div class="card-header bg-white border-white">
                        <div class="row">
                            <div class="col-1">
                                <img src="{{route('profile_picture',$forum->userId)}}" class="rounded-circle"
                                    width="100%" height="100%">
                            </div>
                            <div class="col">
                                <div class="row">
                                    {{$forum->username}}
                                </div>
                                <div class="row text-secondary">
                                    <small>
                                        {{$forum->created_at->locale('es-ES')->isoFormat('LLLL')}}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$forum->title}}</h5>
                        <p class="card-text">{{$forum->description}}
                        </p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{route('forums.show',$forum->id)}}">ver foro</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection