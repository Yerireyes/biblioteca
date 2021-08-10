@extends('layouts.app')

@section('template_title')
Editar Perfil
@endsection

@section('content')

<section class="content container-fluid">
    
    <div class="">
        
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Editar Perfil</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" language="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" value="{{$user->email}}"
                                aria-describedby="emailHelp">
                           
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre Completo</label>
                            <input name="fullName" type="text" class="form-control" id="exampleInputPassword1" value="{{$user->fullName}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Nombre de Usuario</label>
                            <input name="username"  type="text" class="form-control" id="exampleInputPassword1" value="{{$user->username}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Foto de Perfil</label>
                            <input type="file" name="profilePicture" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection