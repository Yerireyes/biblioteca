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
                        @if(str_contains($rol->accion,'DescargarDocumento'))
                            <a class="btn btn-sm btn-primary"
                                href="{{route('documents.download',$note->documentId)}}">descargar</a>
                            @endif
                            <a class="btn btn-primary btn-sm" href="{{route('forums.index',$note->documentId)}}">ver
                                Foros</a>
                            <br>
                            <div class="container mt-3 p-0">
                                <div class="row justify-content-between">
                                    <div class="col p-0">
                                        
                                        @if($note->meGusta($note->documentId))
                                        <a href="{{route('document.deleteLike',$note->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @else
                                        <a href="{{route('document.like',$note->documentId)}}">

                                            <img src="https://img.icons8.com/ios/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @endif
                                        <h6>{{$note->cantidadMeGusta($note->documentId)}}</h6>
                                    </div>
                                    <div class="p-0 float-right">
                                        @if($note->noMeGusta($note->documentId))
                                        <a href="{{route('document.deleteDislike',$note->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumbs-down.png"/>
                                        </a>
                                        @else
                                        <a href="{{route('document.disLike',$note->documentId)}}">
                                            <img src="https://img.icons8.com/ios/35/000000/thumbs-down.png" />
                                        </a>
                                        @endif
                                        <h6>{{$note->cantidadNoMeGusta($note->documentId)}}</h6>
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