<template>

    <div>
        <div class="form-group" >
            <input type="checkbox" id="Eventos" value="Eventos" v-model="checkedEventos">
            <label for="Eventos">Ver Informacion de Eventos</label>
        </div>
        <div class="form-group">
            <label for="tipo_evento_id" class="col-md-2 control-label">Tipo Evento</label>

                <select v-model="tipo_eventos" placeholder="Seleccione" class="form-control" name="tipo_evento_id">
                    <option value="" disabled  hidden>Seleccione la Evento</option>
                    <option v-for="option in options" v-bind:value="option.value" >
                        {{ option.text }}
                    </option>
                </select>
        </div>

            <div class="form-group" v-if="checkedEventos">
                 <span>
                   <ul>
                       <div class="panel panel-primary" v-for="option in options">
                           <div class="panel-heading">
                               {{ option.text }}
                           </div>
                           <div class="panel-body">
                               {{ option.descripcion }}
                           </div>
                       </div>
                   </ul>
               </span>

            </div>

    </div>

</template>

<script>
    export default {

        props: ['evento_id'],

        data: function(){
            return {
                categoria_adverso: '',
                options: [],
                checkedEventos: '',
            }
        },

        created: function () {
            this.getTipoEvento();
            this.tipo_eventos = this.evento_id;
            console.log('ddd');

        },
        methods :
        {
            getTipoEvento: function(){
                this.$http.get('/tipoEventos').then(function(response){
                    this.options = response.body;
                });
            }
        }
    }
</script>