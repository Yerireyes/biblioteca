@extends('home2')

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Apuntes</span>
                    </div>
                </div>
                <div class="row">
                @foreach($notes as $note)
                <div class="card mx-5" style="width: 13rem;">
                    <img src="{{route('cover_Page',$note->documentId)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$note->title}}</h5>
                        <br>
                        <p class="card-text">{{$note->description}}
                        </p>
                            <a class="btn btn-primary" href="{{route('documents.download',$note->documentId)}}">descargar</a>
                            <a class="btn btn-primary" href="{{route('forums.index',$note->documentId)}}">ver Foros</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
@endsection