@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="bs-docs-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <legend>Reporte de {!! $tipo_incidentes->nom_incidente !!} por Categorias-Problemas del
                            {!! $fecha_inicio !!} al {!! $fecha_fin !!}</legend>
                    </div>
                </div>
            </div>
            {{--<div id="chart-div" style="width: 1200px; height: 500px;"></div>--}}
            {{--{!! $lava->render('DonutChart', 'r_serv', 'chart-div') !!}--}}

            {{--<div id="perf_div"></div>--}}
            {{--{!! $lavas->render('ColumnChart', 'Finances', 'perf_div') !!}--}}



            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Problema</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categorias as $categoria)
                            @if(count($categoria->problemas) > 0)
                                <tr>
                                    <td>{!! $categoria->nom_categoria !!} </td>
                                    <td colspan="2">

                                            <table class="table table-striped table-hover">
                                                @foreach($categoria->problemas as $problema)
                                                    <tr>
                                                        <td>{!! $problema->nom_problema !!}</td>
                                                        <td>{!! $problema->total !!}</td>
                                                    </tr>

                                                @endforeach

                                            </table>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        {{--<tr>--}}
                            {{--<td>Total</td>--}}
                            {{--<td>{!! $totalServicio_primer !!}</td>--}}
                            {{--<td>100%</td>--}}
                        {{--</tr>--}}
                        </tbody>

                    </table>
                </div>
            </div>

            <a href="{{ route("reportes.mensual_categoria") }}" class="btn btn-raised btn-info">Atras</a>


        </div>



    </div>
@endsection