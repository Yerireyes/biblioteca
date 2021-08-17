@extends('layouts.app')

@section('template_title')
    Gestion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Gestion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('managements.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Nombre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($managements as $management)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $management->name }}</td>

                                            <td>
                                                <div class="float-right">
                                                <form class="justify-content-end" action="{{ route('managements.destroy',$management->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('managements.show',$management->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('managements.edit',$management->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                <form method="GET" action="{{ route('pdf.storeManagement',$management->id) }}" enctype="multipart/form-data">
                                                    <button type="submit" class="btn btn-sm btn-success "><i class="fa fa-fw fa-edit"></i> Generar Reporte</button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $managements->links() !!}
            </div>
        </div>
    </div>
@endsection