@extends('layouts.app')

@section('template_title')
    Reporte Usuario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Reporte Usuario') }}
                            </span>

                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <label><input type="checkbox" id="cbox1" value="first_checkbox"> Libros</label><br>
                        <label><input type="checkbox" id="cbox2" value="first_checkbox"> Apuntes</label><br>
                        <label><input type="checkbox" id="cbox3" value="first_checkbox"> Tesis</label><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
