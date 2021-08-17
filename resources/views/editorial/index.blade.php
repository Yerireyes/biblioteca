@extends('layouts.app')

@section('template_title')
    Editorial
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Editorial') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('editorials.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    @foreach ($editorials as $editorial)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $editorial->name }}</td>

                                            <td>
                                                <div class="float-right">
                                                <form action="{{ route('editorials.destroy',$editorial->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('editorials.show',$editorial->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('editorials.edit',$editorial->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                                <form method="GET" action="{{ route('pdf.storeEditorial',$editorial->id) }}" enctype="multipart/form-data">
                                                        
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
                {!! $editorials->links() !!}
            </div>
        </div>
    </div>
@endsection
