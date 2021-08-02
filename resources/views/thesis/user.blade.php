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
                            <a class="btn btn-primary" href="{{route('documents.download',$thesis->documentId)}}">descargar</a>
                            <a class="btn btn-primary" href="{{route('forums.index',$thesis->documentId)}}">ver Foros</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
@endsection