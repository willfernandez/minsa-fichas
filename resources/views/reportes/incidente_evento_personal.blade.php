@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bs-docs-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <legend>PERSONAL QUE REPORTAR INCIDENTE/EVENTO ADVERSO</legend>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-md-12 bs-example">

                    <table class="table table-striped table-hover table-bordered table">
                        <thead>
                        <tr class="danger">
                            <th rowspan="3">Personal</th>
                        </tr>
                        <tr class="danger">
                            <th colspan="{!! date('m') !!}" style="text-align: center;">Incidentes adversos</th>
                            <th rowspan="3" style="text-align: center;" >Total</th>
                        </tr>
                        <tr>
                            @foreach($meses as $clave => $valor)
                                @if($clave <= date('m'))
                                    <th> {!! $valor !!} </th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personals as $personal)
                            <tr>
                                <th>{!! $personal->tip_personal !!}</th>
                                @foreach($incidentes as $clave_personal => $array_meses)
                                    @if($clave_personal == $personal->id)
                                        @foreach($array_meses as $total_mes)
                                            <td>{!! $total_mes !!} </td>
                                        @endforeach
                                    @endif
                                @endforeach
                                <th class="info">{!! $personal->total_incidente !!}</th>
                            </tr>
                        @endforeach

                        <tr class="success">
                            <th>TOTAL</th>
                            @foreach($total_incidentes_meses as $clave => $total_mes)
                                @if($clave <= date('m'))
                                <th>
                                    {!! $total_mes !!}
                                </th>
                                @endif
                            @endforeach
                            <th>{!! $total_incidentes_consolidado !!}</th>
                        </tr>
                        </tbody>
                    </table>


                    {{--//EVENTO--}}

                    <table class="table table-striped table-hover table-bordered table">
                        <thead>
                        <tr class="danger">
                            <th rowspan="3">Personal</th>
                        </tr>
                        <tr class="danger">
                            <th colspan="{!! date('m') !!}" style="text-align: center;">Eventos adversos</th>
                            <th rowspan="3" style="text-align: center;" >Total</th>
                        </tr>
                        <tr>
                            @foreach($meses as $clave => $valor)
                                @if($clave <= date('m'))
                                    <th> {!! $valor !!} </th>
                                @endif
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($personals as $personal)
                            <tr>
                                <th>{!! $personal->tip_personal !!}</th>
                                @foreach($eventos as $clave_personal => $array_meses)
                                    @if($clave_personal == $personal->id)
                                        @foreach($array_meses as $total_mes)
                                            <td>{!! $total_mes !!} </td>
                                        @endforeach
                                    @endif
                                @endforeach
                                <th class="info">{!! $personal->total_evento !!}</th>
                            </tr>
                        @endforeach

                        <tr class="success">
                            <th>TOTAL</th>
                            @foreach($total_eventos_meses as $clave => $total_mes)
                                @if($clave <= date('m'))
                                    <th>
                                        {!! $total_mes !!}
                                    </th>
                                @endif
                            @endforeach
                            <td>{!! $total_eventos_consolidado !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{--<a href="{{ route("reportes.mensual_categoria") }}" class="btn btn-raised btn-info">Atras</a>--}}


        </div>



    </div>
@endsection