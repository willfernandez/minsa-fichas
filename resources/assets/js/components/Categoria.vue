<template>
    <div>
        <select v-model="categoria_adverso" placeholder="Seleccione"  class="form-control" name="categoria_adverso_id">
            <option value="" disabled  hidden>Seleccione la categoria</option>
            <option v-for="option in options" v-bind:value="option.value" >
                {{ option.text }}
            </option>
        </select>

        <div class="col-md-5">
            <label for="select111" class="col-md-2 control-label">PROBLEMA</label>
                <select v-model="problemas" placeholder="Seleccione" class="form-control" name="problema_id" multiple>
                    <option value="" disabled  hidden>Seleccione el Problema</option>
                    <option v-for="option_problema in options_problema" v-bind:value="option_problema.value" >
                        {{ option_problema.text }}
                    </option>
                </select>
        </div>



    </div>



</template>

<script>
    export default {
        data: function(){
            return {
                categoria_adverso: [],
                options: [],
                problemas: [],
                options_problema: []

            }
        },
        created: function () {
            this.getCategoria();
        },
        watch: {
            categoria_adverso: function()
            {
                this.getProblemas(this.categoria_adverso)
            }
        },
        methods :
        {
            getCategoria: function(){
                console.log('entre');
                this.$http.get('/categorias').then(function(response){
                     this.options = response.body;
                });
            },
            getProblemas: function(categoria_adverso){
                this.$http.get('/categorias/findProblema/'+categoria_adverso).then(function(response){
                    this.options_problema = response.body;
                });
            },
        }
    }
</script>