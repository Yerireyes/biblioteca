@extends('layouts.app')

@section('template_title')
    Libros
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Libros') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                <a href="{{ route('pdf.bookCatalogue') }}" class="btn btn-sm btn-success float-right border-white"  data-placement="left">
                                  {{ __('Generar Catalogo') }}
                                </a>
                                <a href="{{ route('pdf.bookPopular') }}" class="btn btn-sm btn-success float-right border-white"  data-placement="left">
                                  {{ __('Generar Popular') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Titulo</th>
										<th>Edicion</th>
										<th>Idioma</th>
										<th>Nro Descargas</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            
											<td>{{ $book->title }}</td>
											<td>{{ $book->edition }}</td>
											<td>{{ $book->languageName($book->languageId) }}</td>
											<td>{{ $book->downloadCounter }}</td>


                                            <td>
                                                <form action="{{ route('books.destroy',$book->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('books.show',$book->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('books.edit',$book->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('books.editorials',$book->id) }}"><i class="fa fa-fw fa-edit"></i> Editoriales</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                    
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection
