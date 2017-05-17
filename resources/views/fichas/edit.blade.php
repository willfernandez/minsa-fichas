@extends('layouts.app')

@section('content')
{!! $ficha->paciente !!}
    <div id="ex">
        <div class="container" >
            <div class="row">
                <div class="col-md-12">
                    <h1>FORMATO DE REGISTRO Y REPORTE DE INCIDENTES Y EVENTOS ADVERSOS - EDITAR</h1>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="well bs-component">
                @include('fichas.partials.form',['ficha'=>$ficha,'paciente' => $paciente, 'serviciosSelect' => $serviciosSelect,'url' => 'fichas/'.$ficha->id, 'method' => 'PUT'])
            </div>
        </div>
    </div>


@endsection