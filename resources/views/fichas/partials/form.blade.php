{!! Form::open(array('url' => $url, 'method' => $method, 'class' => 'form-horizontal')) !!}
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

    <div class="col-md-4">

        <label for="fecha_ficha" class="col-md-2 control-label">Fecha</label>
        <div class="col-md-10">
            {!! Form::date('fecha_ficha', \Carbon\Carbon::now()) !!}
        </div>
    </div>

    <div class="col-md-4">

        <label for="servicio_id" class="col-md-2 control-label">Servicio</label>
        <div class="col-md-10">
            {!! Form::select('servicio_id', $serviciosSelect, $ficha->servicio_id, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
        </div>
    </div>

    <div class="col-md-4">
        <label for="turno" class="col-md-2 control-label">Turno</label>
        <div class="col-md-10">
            {!! Form::select('turno', config('options.turnos'), $ficha->turno, ['placeholder' => 'Seleccione Turno', 'class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <div class="form-group">
            <label for="diagnostico" class="col-md-2 control-label"> Diagnostico Del Paciente</label>
            <div class="col-md-10">
                <strong>
                    {!! Form::textarea('diagnostico', $ficha->diagnostico ,['class' => 'form-control', 'rows' => '10', 'cols' => '10']) !!}
                </strong>
            </div>
        </div>
    </div>
</div>


<div class="row form-group">
    <div class="col-md-4 col-md-offset-2">
            <v-incidente :incidente_id="{!! $ficha->tipo_incidente_id !!}"></v-incidente>
    </div>

    <div class="col-md-4 col-md-offset-1">
            <v-evento :evento_id="{!! $ficha->tipo_evento_id !!}"></v-evento>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <label for="select111" class="col-md-2 control-label">CATEGORÍA DEL INCIDENTE/EVENTO ADVERSO</label>
        <div class="col-md-10">
            <v-categoria :categoria_id="{!! $ficha->categoria_adverso_id !!}" :problema_id="{!! $ficha->problema_id !!}"></v-categoria>
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <label for="descrip_suceso" class="col-md-2 control-label"> DESCRIPCION DEL SUCESO</label>
        <div class="col-md-10">
            <strong>
                {!! Form::textarea('descrip_suceso', $ficha->descrip_suceso ,['class' => 'form-control', 'rows' => '10', 'cols' => '10']) !!}
            </strong>
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-10">
        <label for="personal_id" class="col-md-2 control-label">Personal</label>
        <div class="col-md-5">
            {!! Form::select('personal_id', $personalsSelect, $ficha->personal_id, ['class' => 'form-control', 'placeholder' => 'Seleccione']) !!}
        </div>
    </div>
</div>

<div class="row form-group">
    <div class="col-md-10 col-md-offset-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>

{!! Form::close() !!}