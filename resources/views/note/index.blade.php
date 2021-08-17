@extends('layouts.app')

@section('template_title')
    Apuntes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Apuntes') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
                                </a>
                                <a href="{{ route('pdf.noteCatalogue') }}" class="btn btn-sm btn-success float-right border-white"  data-placement="left">
                                  {{ __('Generar Catalogo') }}
                                </a>
                                <a href="{{ route('pdf.notePopular') }}" class="btn btn-sm btn-success float-right border-white"  data-placement="left">
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
										<th>Docente</th>
										<th>Materia</th>
										<th>Gestion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>{{ $note->id }}</td>
                                            
											<td>{{ $note->title }}</td>
											<td>{{ $note->professor }}</td>
											<td>{{ $note->name }}</td>
											<td>{{ $note->managementName($note->managementId) }}</td>

                                            <td>
                                                <form action="{{ route('notes.destroy',$note->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notes.show',$note->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notes.edit',$note->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
