@extends('home2')

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">Mostrar Tesis</span>
                    </div>
                </div>
                <div class="row">
                @foreach($theses as $thesis)
                <div class="card mx-5" style="width: 13rem;">
                    <img src="{{route('cover_Page',$thesis->documentId)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$thesis->title}}</h5>
                        <br>
                        <p class="card-text">{{$thesis->description}}
                        </p>
                        @if(str_contains($rol->accion,'DescargarDocumento'))
                            <a class="btn btn-sm btn-primary"
                                href="{{route('documents.download',$thesis->documentId)}}">descargar</a>
                            @endif
                            <a class="btn btn-primary btn-sm" href="{{route('forums.index',$thesis->documentId)}}">ver
                                Foros</a>
                            <br>
                            <div class="container mt-3 p-0">
                                <div class="row justify-content-between">
                                    <div class="col p-0">
                                        
                                        @if($thesis->meGusta($thesis->documentId))
                                        <a href="{{route('document.deleteLike',$thesis->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @else
                                        <a href="{{route('document.like',$thesis->documentId)}}">

                                            <img src="https://img.icons8.com/ios/35/000000/thumb-up--v1.png" />
                                        </a>
                                        @endif
                                        <h6>{{$thesis->cantidadMeGusta($thesis->documentId)}}</h6>
                                    </div>
                                    <div class="p-0 float-right">
                                        @if($thesis->noMeGusta($thesis->documentId))
                                        <a href="{{route('document.deleteDislike',$thesis->documentId)}}">
                                            <img src="https://img.icons8.com/ios-filled/35/000000/thumbs-down.png"/>
                                        </a>
                                        @else
                                        <a href="{{route('document.disLike',$thesis->documentId)}}">
                                            <img src="https://img.icons8.com/ios/35/000000/thumbs-down.png" />
                                        </a>
                                        @endif
                                        <h6>{{$thesis->cantidadNoMeGusta($thesis->documentId)}}</h6>
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