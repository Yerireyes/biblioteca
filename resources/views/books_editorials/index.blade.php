@extends('layouts.app')

@section('template_title')
    Editoriales
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Editoriales') }}
                            </span>

                             <div class="float-right">
                                <form action="{{ route('books.createEditorial',$book->id) }}" method="post">
                                    @csrf
                             <select class="form-select" aria-label="Default select example" name="editorialId">
                                @foreach($editorialsAvailable as $editorial)
                                <option value="{{$editorial->id}}">{{$editorial->name}}</option>
                            @endforeach
                            <!-- <option selected>Open this select menu</option> -->
                        </select>
                                <input type="submit" value="asignar Editorial" class="btn btn-primary btn-sm float-right">
                                </form>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
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
                                            <td>{{ $editorial->id }}</td>
                                            
											<td>{{ $editorial->name }}</td>

                                            <td>
                                                <form action="{{ route('books.editorialsDestroy',[$book->id, $editorial->id]) }}" method="POST">
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
