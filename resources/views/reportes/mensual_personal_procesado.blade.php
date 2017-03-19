@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="bs-docs-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <legend>Reporte PERSONAL DE SALUD QUE NOTIFICA INCIDENTES Y EVENTOS ADVERSOS
                            {!! $fecha_inicio !!} al {!! $fecha_fin !!}</legend>
                    </div>
                </div>
            </div>
            <div id="chart-div" style="width: 1200px; height: 500px;"></div>
            {!! $lava->render('DonutChart', 'r_serv', 'chart-div') !!}





            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th>Personal que Registra</th>
                            <th>Nro</th>
                            <th>%</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personals as $personal)
                                <tr>
                                    <td>{!! $personal->tip_personal !!} </td>
                                    <td>{!! $personal->total !!} </td>
                                    <td> {!! $personal->porcentaje !!}</td>
                                </tr>
                        @endforeach

                        <tr>
                        <td>Total</td>
                        <td>{!! $total !!}</td>
                        <td>100%</td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>

            <a href="{{ route("reportes.mensual_personal") }}" class="btn btn-raised btn-info">Atras</a>


        </div>



    </div>
@endsection