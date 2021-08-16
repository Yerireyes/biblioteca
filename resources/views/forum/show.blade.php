@extends('home2')

@section('content')

<a href="{{route('forums.index',$forum->documentId)}}" class="btn btn-outline-secondary">volver</a>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-1">
                <img src="{{route('profile_picture',$forum->userId)}}" class="rounded-circle" width="100%"
                    height="100%">
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
            @if(Auth::id()==$forum->userId || Auth::user()->roleid==1 || str_contains($rol->accion,'EditarForo'))
            <div class="col-1">
                <div class="dropdown">
                    <button class="btn btn-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                            <path
                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                        </svg>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="{{route('forums.edit',$forum->id)}}">Editar</a></li>
                        @if(str_contains($rol->accion,'EliminarForo') || Auth::user()->roleid==1)
                        <form action="{{route('forums.delete',$forum->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <li><input type="submit" class="dropdown-item" value="Eliminar" /></li>
                        </form>
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
        <br>
        <div class="container ml-3">
            <div class="row">
                <h5 class="card-title">{{$forum->title}}</h5>
            </div>
            <div class="row">
                <p class="card-text">{{$forum->description}}</p>
            </div>
        </div>
    </div>
    <div class="row m-3">
        @if(str_contains($rol->accion,'CrearComentario'))
        <div class="container border border-muted m-3 py-3">
            <div class="row">
                <div class="col-1" style="height:2.8rem;">
                    <img src="{{route('profile_picture',Auth::id())}}" class="rounded-circle" width="100%"
                        height="100%">
                </div>
                <div class="col">
                    <div class="row">
                        {{Auth::user()->username}}
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <form action="{{route('comments.create')}}" method="post" class="w-100" autocomplete="off">
                            @csrf
                            <input name="content" type="text" class="form-control" placeholder="Escribe un Comentario">
                            <input type="hidden" name="forumId" value="{{$forum->id}}">
                        </form>

                    </div>
                </div>

            </div>
        </div>
        @endif
        @foreach($comments as $comment)

        <div class="container border border-muted m-3 py-3">
            <div class="row">
                <div style="width:2.5rem;" class="mx-3">
                    <img src="{{route('profile_picture',$comment['userId'])}}" class="rounded-circle" width="100%"
                        height="100%">
                </div>
                <div class="col">
                    <div class="row">
                        
                        {{$comment['username']}}
                    </div>
                    <div class="row text-secondary">
                        <small>
                            {{$comment['created_at']->locale('es-ES')->isoFormat('LLLL')}}
                        </small>
                    </div>

                </div>
                @if(Auth::id()==$comment['userId'] || Auth::user()->roleid==1 || str_contains($rol->accion,'EditarComentario'))
                <div class="col-1">
                    <div class="dropdown">
                        <button class="btn btn-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button data-bs-toggle="collapse" data-bs-target=".multi-collapse"
                                    aria-controls="multiCollapseExample1 multiCollapseExample2"
                                    class="dropdown-item">Editar</button></li>
                            @if(str_contains($rol->accion,'EditarComentario') || Auth::user()->roleid==1)
                            <form action="{{route('comments.delete',$comment['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <li><input type="submit" class="dropdown-item" value="Eliminar" /></li>
                            </form>
                            @endif
                        </ul>
                    </div>

                </div>
                @endif
            </div>

            <br>
            <div class="row">
                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                    <div class="col ml-5">
                        {{$comment['content']}}
                    </div>
                </div>
                <div class="col ml-5">
                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                        <form action="{{route('comments.update',$comment['id'])}}" class="form-group" method="post"
                            autocomplete="off">
                            @csrf
                            <input class="form-control" type="text" name="content" value="{{$comment['content']}}"
                                id="">
                        </form>
                    </div>
                </div>
                
                <div class="container ml-5 mt-3">
                    <div class="row"><a data-bs-toggle="collapse" href="#subComentarios{{$comment['id']}}">Ver mas</a></div>
                </div>
                <div class="collapse col-11" id="subComentarios{{$comment['id']}}">
                @if(str_contains($rol->accion,'CrearComentario'))
                <div class="container py-3 border border-muted ml-5 my-2">
                    <div class="row">
                        <div style="width: 2.5rem; height: 2.5rem;" class="mx-3">
                            <img src="{{route('profile_picture',Auth::id())}}" class="rounded-circle"
                                width="100%" height="100%">
                        </div>
                        <div class="col">
                            <div class="row">
                                {{Auth::user()->username}}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row ml-5">
                        <div class="col">
                            <div class="input-group mb-3">
                                <form action="{{route('comments.create')}}" method="post" class="w-100" autocomplete="off">
                                    @csrf
                                    <input name="content" type="text" class="form-control" placeholder="Escribe un Comentario">
                                    <input type="hidden" name="forumId" value="{{$forum->id}}">
                                    <input type="hidden" name="superCommentId" value="{{$comment['id']}}">
                                </form>
        
                            </div>
                        </div>
        
                    </div>
                </div>
                @endif

                @foreach($comment['subComments'] as $subComment)
                <div class="container py-3 border border-muted ml-5 my-2">
                    <div class="row">
                        <div style="width:2.5rem;" class="mx-3">
                            <img src="{{route('profile_picture',$subComment->userId)}}" class="rounded-circle"
                                width="100%" height="100%">
                        </div>
                        <div class="col">
                            <div class="row">
                                {{$subComment->username}}
                            </div>
                            <div class="row text-secondary">
                                <small>
                                    {{$subComment->created_at->locale('es-ES')->isoFormat('LLLL')}}
                                </small>
                            </div>

                        </div>
                        @if(Auth::id()==$comment['userId'] || Auth::user()->roleid==1)
                <div class="col-1">
                    <div class="dropdown">
                        <button class="btn btn-white" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                <path
                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><button data-bs-toggle="collapse" data-bs-target=".multi-collapse"
                                    aria-controls="multiCollapseExample1 multiCollapseExample2"
                                    class="dropdown-item">Editar</button></li>
                            <form action="{{route('comments.delete',$subComment->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <li><input type="submit" class="dropdown-item" value="Eliminar" /></li>
                            </form>
                        </ul>
                    </div>

                </div>
                @endif
                    </div>
                    <br>
                    <div class="row ml-5">
                        {{$subComment->content}}
                    </div>
                </div>
                @endforeach
            </div>
            </div>

        </div>
        @endforeach
    </div>
</div>
@endsection