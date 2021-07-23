@extends('layouts.app')

@section('template_title')
Cambiar Rol
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Cambiar Rol</span>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user->id) }}" subject="form"
                        enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        @csrf

                        <label for="">{{$user->fullName}}</label>

                        <br>
                        <br>
                        <select class="form-select" aria-label="Default select example" name="roleid">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->roleName}}</option>
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
                        <input type="submit" value="guardar">

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection