@extends('layouts.app')

@section('content')

<div id="ex">
    <div class="container" >
        <div class="row">
            <div class="col-md-12">
                <h1>FORMATO DE REGISTRO Y REPORTE DE INCIDENTES Y EVENTOS ADVERSOS</h1>
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
            @include('fichas.partials.form',['ficha'=>$ficha,'paciente' => $paciente, 'serviciosSelect' => $serviciosSelect,'url' => 'fichas', 'method' => 'POST'])
        </div>
    </div>
</div>


@endsection