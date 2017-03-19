@extends('layouts.app')

@section('content')
<div class="container">
        <div class="bs-docs-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                    </div>
                    <table class="table table-striped table-hover ">
                        <thead>
                        <tr>
                            <th><h2> Servicio </h2></th>
                            <th colspan="2"><h2> I Trimestre </h2></th>
                            <th colspan="2"><h2> II Trimestre</h2></th>

                        </tr>
                        <tr>
                            <th></th>
                            <th>Numero</th>
                            <th>Porcentaje</th>
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

                                <td>{!! $t['total_segundo'] !!} </td>
                                <td>{!! $t['porcentaje_segundo'] !!}%</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{!! $totalServicio_primer !!}</td>
                            <td>100%</td>
                            <td>{!! $totalServicio_segundo !!}</td>
                            <td>100%</td>
                        </tr>
                        </tbody>

                    </table>
                </div>
                {{--<div class="col-md-4">--}}
                    {{--<div class="page-header">--}}
                        {{--<h1 id="tables">II Trimestre</h1>--}}
                    {{--</div>--}}
                    {{--<table class="table table-striped table-hover ">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>Numero</th>--}}
                            {{--<th>Porcentaje</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($total_segundo as $t)--}}
                            {{--<tr>--}}
                                {{--<td>{!! $t['total'] !!} </td>--}}
                                {{--<td>{!! $t['porcentaje'] !!}%</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                       {{----}}
                        {{--</tbody>--}}

                    {{--</table>--}}
                {{--</div>--}}


            </div>

        </div>

    <div id="chart-div"></div>
    {!! $lava->render('ColumnChart', 'IMDB', 'chart-div') !!}
</div>
@endsection