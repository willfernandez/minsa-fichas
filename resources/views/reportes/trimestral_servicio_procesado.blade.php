@extends('layouts.app')

@section('content')

    <div class="bs-docs-header">
        <div class="container">
            <h3>Reporte de {!! $tipo_incidente->nom_incidente !!} {!! $servicio->nom_servicio !!}</h3>
        </div>
    </div>

    <div class="container">


        <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr class="info">
                            <th>Mes</th>
                            <th>Diagnostico</th>
                            <th>Edad</th>
                            <th>Sexo</th>
                            <th>Trabajador que Reporta</th>
                            <th>Categoria del evento adverso</th>
                            <th>Problema</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th colspan="7" class="danger">Primer Trimestre</th>
                        </tr>
                        @foreach($fichas_primer as $ficha_p)
                            <tr>
                                <td>{!! $ficha_p->fecha_ficha !!} </td>
                                <td>{!! $ficha_p->diagnostico !!} </td>
                                <td>{!! $ficha_p->paciente->edad_paciente !!} </td>
                                <td>{!! $ficha_p->paciente->sexo !!} </td>
                                <td>{!! $ficha_p->personal->tip_personal !!} </td>
                                <td>{!! $ficha_p->categoriaAdverso->nom_categoria !!} </td>
                                <td>{!! $ficha_p->problema->nom_problema !!} </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="7" class="danger">Segundo Trimestre</th>
                        </tr>
                        @foreach($fichas_segundo as $ficha_p)
                            <tr >
                                <td>{!! $ficha_p->fecha_ficha !!} </td>
                                <td>{!! $ficha_p->diagnostico !!} </td>
                                <td>{!! $ficha_p->paciente->edad_paciente !!} </td>
                                <td>{!! $ficha_p->paciente->sexo !!} </td>
                                <td>{!! $ficha_p->personal->tip_personal !!} </td>
                                <td>{!! $ficha_p->categoriaAdverso->nom_categoria !!} </td>
                                <td>{!! $ficha_p->problema->nom_problema !!} </td>
                            </tr>
                        @endforeach

                        <tr>
                            <th colspan="7" class="danger">Tercer Trimestre</th>
                        </tr>
                        @foreach($fichas_tercer as $ficha_p)
                            <tr>
                                <th>{!! $ficha_p->fecha_ficha !!} </th>
                                <td>{!! $ficha_p->diagnostico !!} </td>
                                <td>{!! $ficha_p->paciente->edad_paciente !!} </td>
                                <td>{!! $ficha_p->paciente->sexo !!} </td>
                                <td>{!! $ficha_p->personal->tip_personal !!} </td>
                                <td>{!! $ficha_p->categoriaAdverso->nom_categoria !!} </td>
                                <td>{!! $ficha_p->problema->nom_problema !!} </td>
                            </tr>
                        @endforeach


                        </tbody>

                    </table>
                </div>
            </div>
            {{--<a href="{{ route("reportes.mensual_servicio") }}" class="btn btn-raised btn-info">Atras</a>--}}
    </div>


@endsection