@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bs-docs-section">
            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {!! $error !!}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>REPORTE DE INCIDENTES ADVERSOS y/o EVENTOS ADVERSOS POR SERVICIO</h2>
                    </div>
                    {!! Form::open(array('url' => 'reportes/mensualServicioProcesado', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                    <table class="table table-striped table-hover ">
                        <tbody>
                            <tr>
                                <td>
                                    <label for="fecha_inicio" class="col-md-2 control-label">De: </label>
                                    <div class="col-md-10">
                                    {!! Form::date('fecha_inicio', '') !!}
                                    </div>
                                </td>
                                <td>
                                    <label for="fecha_fin" class="col-md-2 control-label">Hasta </label>
                                    <div class="col-md-10">
                                    {!! Form::date('fecha_fin', '') !!}
                                    </div>
                                </td>
                                <td><div class="form-group">
                                        <label for="tipo_incidente_id" class="col-md-2 control-label">Tipo Incidente </label>

                                        <div class="col-md-12">
                                            {!! Form::select('tipo_incidente_id', $tipoIncidenteSelect, null, ['placeholder' => 'Seleccione Tipo Incidente', 'class' => 'form-control']) !!}

                                        </div>
                                    </div></td>
                                <td>
                                    <div class="form-group">
                                        <div class="col-md-10 ">
                                            <button type="submit" class="btn btn-primary">Generar Reporte</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

        {{--<div id="chart-div"></div>--}}
        {{--{!! $lava->render('ColumnChart', 'IMDB', 'chart-div') !!}--}}
    </div>
    <script>
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
            startDate: '-3d'
        });
    </script>
@endsection