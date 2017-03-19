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
                <span class="glyphicon glyphicon-edit"></span> Generar Fichass
            </button>

            <button class="edit-modal btn btn-danger" v-on:click="deleter(paciente)">
                <span class="glyphicon glyphicon-edit"></span> Borrar Registro
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
                this.$emit('deleter')
            }
        }
    }
</script>