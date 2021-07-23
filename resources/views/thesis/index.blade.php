@extends('layouts.app')

@section('template_title')
    Tesis
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tesis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('theses.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
										<th>Tipo</th>
										<th>NroDescargas</th>
										<th>Fecha de Defensa</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($theses as $thesis)
                                        <tr>
                                            <td>{{ $thesis->id }}</td>
                                            
											<td>{{ $thesis->title }}</td>
											<td>{{ $thesis->type }}</td>
											<td>{{ $thesis->downloadCounter }}</td>
											<td>{{ $thesis->defenseDate }}</td>

                                            <td>
                                                <form action="{{ route('theses.destroy',$thesis->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('theses.show',$thesis->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('theses.edit',$thesis->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
