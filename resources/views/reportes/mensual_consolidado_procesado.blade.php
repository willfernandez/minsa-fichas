@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered">
            {{--<thead>--}}
            {{--<tr>--}}
                {{--<th>Categoria</th>--}}
                {{--<th>Problema</th>--}}
                {{--<th>Total</th>--}}
            {{--</tr>--}}
            {{--</thead>--}}
            <tbody>
            <?php $i=0 ?>
            <?php $j=0 ?>
            @foreach($categorias as $categoria)
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
                        <td>
                            <table class="table table-striped table-hover">
                                @foreach($categoria->problemas as $problema)
                                    <tr>
                                    @foreach($servicios as $servicio)
                                        @foreach($tipo_incidentes as $tipo_incidente)
                                            <td>{!! $total_incidente[$i][$j] !!}</td>
                                            <?php $j++; ?>
                                        @endforeach
                                    @endforeach
                                    <?php $i++; ?>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
            @endforeach

            {{--<tr>--}}
            {{--<td>Total</td>--}}
            {{--<td>{!! $totalServicio_primer !!}</td>--}}
            {{--<td>100%</td>--}}
            {{--</tr>--}}
            </tbody>

        </table>

    </div>
@endsection