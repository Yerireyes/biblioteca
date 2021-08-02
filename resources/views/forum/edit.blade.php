@extends('home2')

@section('template_title')
    Editar Foro
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Foro</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('forums.update',$forum->id) }}"  editorial="form" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('forum.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
