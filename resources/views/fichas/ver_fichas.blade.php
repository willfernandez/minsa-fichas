@extends('layouts.app')

@section('content')
    <div class="container-fluid" >

    <div class="row ">
            <div class="col-sm-3 col-md-2 sidebar">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Nro Ficha{{ $fichas[0]->paciente->num_ficha }}</h3>
                    </div>
                    <div class="panel-body">
                        <ul>

                        </ul>
                        <strong>Nombre</strong> {{ $fichas[0]->paciente->nom_paciente }} {{ $fichas[0]->paciente->ape_paciente }}
                        <strong>Edad</strong> {{ $fichas[0]->paciente->edad_paciente }}
                        <strong>Sexo</strong> {{ $fichas[0]->paciente->sexo }}
                    </div>
                </div>
            </div>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h3> Fichas Registradas</h3>

                <table class="table">
                    <thead>
                        <th>Servicio</th>
                        <th>Diagnóstico</th>
                        <th>Fecha de Creación</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach($fichas as $ficha)
                            <tr>
                                <td> {!! $ficha->id  !!} </td>
                                <td> {!! $ficha->diagnostico !!} </td>
                                <td> {!! $ficha->created_at->format('M d Y') !!} </td>
                                <td>
                                    <a href="{{ url('/fichas/edit/'. $ficha->id) }}">
                                    <span class="glyphicon glyphicon-search btn-lg" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    </div>

@endsection