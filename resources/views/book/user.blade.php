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

                            <p style="height: 10rem;" class="card-text overflow-auto">{{$book->description}}
                            </p>
                            <a class="btn btn-sm btn-primary"
                                href="{{route('documents.download',$book->documentId)}}">descargar</a>
                            <a class="btn btn-primary btn-sm" href="{{route('forums.index',$book->documentId)}}">ver
                                Foros</a>
                            <br>
                            <div class="container mt-3 p-0">
                                <div class="row justify-content-between">
                                    <div class="col p-0">
                                        @if($book->meGusta($book->documentId))
                                        <a href="{{route('document.deleteLike',$book->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @else
                                        <a href="{{route('document.like',$book->documentId)}}">

                                            <img src="https://img.icons8.com/ios/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @endif
                                    </div>
                                    <div class="p-0 float-right">
                                        @if($book->noMeGusta($book->documentId))
                                        <a href="{{route('document.deleteDislike',$book->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumbs-down.png"/>
                                        </a>
                                        @else
                                        <a href="{{route('document.disLike',$book->documentId)}}">
                                            <img src="https://img.icons8.com/ios/35/000000/thumbs-down.png" />
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection