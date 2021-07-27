@extends('home2')

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Libros</span>
                    </div>
                </div>
                <div class="row">
                @foreach($books as $book)
                <div class="card mx-5" style="width: 13rem;">
                    <img src="{{route('cover_Page',$book->documentId)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$book->title}}</h5>
                        <br>
                        <p class="card-text">{{$book->description}}
                        </p>
                            <a class="btn btn-primary" href="{{route('documents.download',$book->documentId)}}">descargar</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
@endsection