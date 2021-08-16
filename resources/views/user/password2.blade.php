@extends('home2')

@section('template_title')
Editar Perfil
@endsection

@section('content')

<section class="content container-fluid">
    
    <div class="">
        
        <div class="col-md-12">
            <div class="card border-white">
                <div class="float-right">
                    <a href="{{ url()->previous() }}" class="btn btn-primary float-right">Volver</a>
                </div>
            </div>
            @includeif('partials.errors')

            @if ($message = Session::get('errors'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Cambiar Contraseña</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.passwordGuardar2') }}" language="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contraseña Actual</label>
                            <input name="password" type="password" class="form-control" id="exampleInputEmail1" value=""
                                aria-describedby="emailHelp">
                           
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nueva Contraseña</label>
                            <input name="oldpassword" type="password" class="form-control" id="exampleInputEmail1" value=""
                                aria-describedby="emailHelp">
                           
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Confirmar nueva Contraseña</label>
                            <input name="oldpassword_confirmation" type="password" class="form-control" id="exampleInputEmail1" value=""
                                aria-describedby="emailHelp">
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection