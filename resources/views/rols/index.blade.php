@extends('layouts.app')

@section('template_title')
    Rol
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Rol') }}
                            </span>
                             <div class="float-right">
                             
                                <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    @foreach ($roles as $rols)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $rols->roleName }}</td>

                                            <td>
                                                <div class="float-right">
                                                <form action="{{ route('roles.destroy',$rols->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('roles.show',$rols->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('roles.edit',$rols->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>


                                                   
                                                </form>
                                                <form method="GET" action="{{ route('pdf.storeRol',$rols->id) }}" enctype="multipart/form-data">
                                                        
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
                {!! $roles->links() !!}
            </div>
        </div>
    </div>
@endsection
