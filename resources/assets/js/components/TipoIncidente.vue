<template>

    <div>

        <div class="form-group" >
            <input type="checkbox" id="Incidentes" value="Incidentes" v-model="checkedIncidentes">
            <label for="Incidentes">Ver Informacion de Incidentes</label>
        </div>

        <div class="form-group">
            <label for="tipo_incidente_id" class="col-md-2 control-label">Tipo Incidente</label>
                <select v-model="tipo_incidentes" placeholder="Seleccione" class="form-control" name="tipo_incidente_id">
                    <option value="" disabled  hidden>Seleccione la categoria</option>
                    <option v-for="option in options" v-bind:value="option.value" >
                        {{ option.text }}
                    </option>
                </select>
        </div>



        <div class="form-group" v-if="checkedIncidentes">
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
        data: function(){
            return {
                categoria_adverso: '',
                options: [],
                checkedIncidentes: '',
            }
        },
        created: function () {
            this.getTipoIncidente();
        },
        methods :
        {
            getTipoIncidente: function(){
                console.log('entreIncidente');
                this.$http.get('/tipoIncidentes').then(function(response){
                    this.options = response.body;
                });
            }
        }
    }
</script>