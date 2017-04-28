<template>
    <tr>
        <td>
            {{ paciente.nom_paciente }}
            {{ paciente.ape_paciente }}
        </td>
        <td>
            {{ paciente.edad_paciente }}
        </td>
        <td>
            <button class="edit-modal btn btn-warning" @click.prevent="generarFicha(paciente)">
                <span class="glyphicon glyphicon-edit"></span> Generar Fichas
            </button>

            <a class="edit-modal btn btn-primary" v-bind:href="'user/fichas/'+ paciente.id">
                <span class="glyphicon glyphicon-edit"></span>
                ver Fichas
            </a>

            <button class="edit-modal btn btn-danger" v-on:click="deleter(paciente)">
                <span class="glyphicon glyphicon-edit"></span> Borrar Registro
            </button>

            <button class="edit-modal btn btn-success" v-on:click="edit(paciente)" data-toggle="modal" data-target="#create-paciente">
                <span class="glyphicon glyphicon-edit"></span> Editar Paciente
            </button>


        </td>
    </tr>

</template>

<script>
    export default {
        props: ['paciente'],

        methods :
        {
            generarFicha: function(paciente){
                window.location.href = 'fichas/'+paciente.id;
            },

            deleter: function(index,paciente){
               // this.$emit('deleter')
            },

            edit: function(index,paciente){
                this.$emit('edit');
            }
        }
    }
</script>