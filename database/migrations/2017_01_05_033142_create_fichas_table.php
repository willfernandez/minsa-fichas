<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');



            $table->integer('servicio_id')->unsigned();
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');

            $table->enum('turno', ['T', 'M', 'N']);

            $table->text('diagnostico');

            $table->integer('tipo_incidente_id')->unsigned();
            $table->foreign('tipo_incidente_id')->references('id')->on('tipo_incidentes')->onDelete('cascade');

            $table->integer('tipo_evento_id')->unsigned();
            $table->foreign('tipo_evento_id')->references('id')->on('tipo_eventos')->onDelete('cascade');

            $table->integer('categoria_adverso_id')->unsigned();
            $table->foreign('categoria_adverso_id')->references('id')->on('categoria_adversos')->onDelete('cascade');

            $table->integer('problema_id')->unsigned();
            $table->foreign('problema_id')->references('id')->on('problemas')->onDelete('cascade');

            $table->text('descrip_suceso');

            $table->integer('personal_id')->unsigned();
            $table->foreign('personal_id')->references('id')->on('personals')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fichas');
    }
}
