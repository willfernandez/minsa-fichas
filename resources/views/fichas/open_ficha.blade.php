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
            {!! Form::open(array('url' => 'fichas', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::open(array('url' => 'fichas', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                        <legend> Paciente: {!! $paciente->nom_paciente.' '.$paciente->ape_paciente!!}</legend>
                        <div class="form-group">
                            <div class="col-md-10">
                                <strong>
                                    {!! Form::hidden('paciente_id', $paciente->id) !!}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4 col-md-offset-2">

                            <label for="servicio_id" class="col-md-2 control-label">Servicio</label>
                            <div class="col-md-10">
                                {!! Form::select('servicio_id', $serviciosSelect, null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
                            </div>
                    </div>

                    <div class="col-md-4 col-md-offset-1">
                            <label for="turno" class="col-md-2 control-label">Turno</label>
                            <div class="col-md-10">
                                <select id="turno"  name="turno" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="M">Mañana</option>
                                    <option value="T">Tarde</option>
                                    <option value="N">Noche</option>
                                </select>
                            </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="diagnostico" class="col-md-2 control-label"> Diagnostico Del Paciente</label>
                            <div class="col-md-10">
                                <strong>
                                    {!! Form::textarea('diagnostico', null ,['class' => 'form-control', 'rows' => '10', 'cols' => '10']) !!}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row form-group">
                    <div class="col-md-4 col-md-offset-2">
                        <v-incidente></v-incidente>
                    </div>

                    <div class="col-md-4 col-md-offset-1">
                        <v-evento></v-evento>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="select111" class="col-md-2 control-label">CATEGORÍA DEL INCIDENTE/EVENTO ADVERSO</label>
                        <div class="col-md-10">
                            <v-categoria></v-categoria>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <label for="descrip_suceso" class="col-md-2 control-label"> DESCRIPCION DEL SUCESO</label>
                        <div class="col-md-10">
                            <strong>
                                {!! Form::textarea('descrip_suceso', null ,['class' => 'form-control', 'rows' => '10', 'cols' => '10']) !!}
                            </strong>
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-10">
                        <label for="personal_id" class="col-md-2 control-label">Personal</label>
                        <div class="col-md-5">
                            {!! Form::select('personal_id', $personalsSelect, null, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
                        </div>
                    </div>
                </div>

                <div class="row form-group">
                        <div class="col-md-10 col-md-offset-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>


@endsection