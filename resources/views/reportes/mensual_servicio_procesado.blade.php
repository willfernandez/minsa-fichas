@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="bs-docs-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <legend>Reporte de {!! $tipo_incidentes->nom_incidente !!} por Servicio del
                            {!! $fecha_inicio !!} al {!! $fecha_fin !!}</legend>
                    </div>
                </div>
            </div>
            <div id="chart-div" style="width: 1200px; height: 500px;"></div>
            {!! $lava->render('DonutChart', 'r_serv', 'chart-div') !!}

            {{--<div id="perf_div"></div>--}}
            {{--{!! $lavas->render('ColumnChart', 'Finances', 'perf_div') !!}--}}



            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Numero</th>
                            <th>Porcentaje</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($total_primer as $t)
                            <tr>
                                <td>{!! $t['nombre'] !!} </td>
                                <td>{!! $t['total'] !!} </td>
                                <td>{!! $t['porcentaje'] !!}%</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{!! $totalServicio_primer !!}</td>
                            <td>100%</td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>

            <a href="{{ route("reportes.mensual_servicio") }}" class="btn btn-raised btn-info">Atras</a>


        </div>



    </div>
@endsection