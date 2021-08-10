@extends('layouts.app')
@section('content')
<a href="{{Auth::user()->roleid==1?'/home':'/home2'}}" class="btn btn-primary">Ir a Casa</a>
<div class="container-fluid mt-5 w-100">
    <div class="row my-3 w-100">
        <div class="col-4">
            <img src="{{route('profile_picture',$user->id)}}" width="100%" height="100%">
        </div>
        <div class="col align-self-center">
            <h3>
                {{'@'.$user->username}}
                
            </h3>
        </div>
        <div class="position-absolute align-self-end row w-100">
            <div class="col-8 ml-auto">
                @if($user->id==Auth::user()->id)
                <a href="{{route('user.configurations')}}" class="btn btn-primary">
                    Editar perfil
                </a>
                <a href="{{route('user.password')}}" class="btn btn-primary">
                    Cambiar Contraseña
                </a>
                @endif
            </div>
        </div>
    </div>
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-primary" id="home-tab" data-toggle="tab" href="#home" role="tab"
                aria-controls="home" aria-selected="true">
                Información
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- INFORMATION -->
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
                <div class="row my-3 border-bottom border-muted">
                    <div class="col-4 text-right">
                        <strong>
                            Nombres:
                        </strong>
                    </div>
                    <div class="col text-left">
                        {{$user->fullName}}
                    </div>
                </div>
                <div class="row my-3 border-bottom border-muted">
                    <div class="col-4 text-right">
                        <strong>
                            Correo:
                        </strong>
                    </div>
                    <div class="col text-left">
                        {{$user->email}}
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-4 text-right">
                        <strong>
                            Se unió:
                        </strong>
                    </div>
                    <div class="col text-left">
                        {{$user->created_at->diffForHumans()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection