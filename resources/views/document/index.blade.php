@extends('layouts.app')

@section('template_title')
    Documento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Documento') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('documents.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Portada</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $document->title }}</td>
											<td>{{ $document->type }}</td>
											<td>{{ $document->downloadCounter }}</td>
											<td>{{ $document->coverPage }}</td>

                                            <td>
                                                <form action="{{ route('documents.destroy',$document->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('documents.show',$document->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('documents.edit',$document->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $documents->links() !!}
            </div>
        </div>
    </div>
@endsection
