<template lang="html">
    <div>
        <div class="form-group row add">
            <div class="col-md-12">
                <h1>Pacientes</h1>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#create-paciente">
                   Agregar Paciente
                </button>
            </div>

            <div class="col-md-6 col-md-offset-6">
                <div class="input-group input-group-sm">
                    <div class="icon-addon addon-md">
                        <input type="text" v-model="query" placeholder="Ingrese el Apellido del Paciente" class="form-control">
                    </div>
                    <span class="input-group-btn">
                      <button type="button" class="btn-sm btn-danger" v-if="!loading" @click="search()">
                        Buscar <i class="fa fa-search"></i>
                        </button>
                        <button type="button" class="btn-sm btn-danger" v-if="loading" disabled="disabled">
                            Buscando... <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-6">
                <p class="bg-danger"> {{ noresult }}</p>
            </div>


        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Edad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td>

                </td>
            </tr>


                <Paciente v-for="(paciente, index) in pacientes" v-bind:paciente="paciente" v-on:deleter="deleteThisRow(index,paciente)" v-on:edit="editThisPaciente(index,paciente)"></Paciente>



                <nav>
                    <ul class="pagination pagination-lg">
                        <li v-if="pagination.current_page > 1">
                            <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                                <span aria-hidden="true"> < </span>
                            </a>
                        </li>
                        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                            <a href="#" @click.prevent="changePage(page)">
                                {{ page }}
                            </a>
                        </li>
                        <li v-if="pagination.current_page < pagination.last_page">
                            <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                                <span aria-hidden="true"> > </span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </tbody>
        </table>

    <div class="modal fade" id="create-paciente" tabindex="-1" role="dialog" aria-labelledby="create-paciente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Paciente</h4>
                </div>
                <div class="modal-body">
                    <form v-on:submit.prevent="createPaciente" method="post" class="form-horizontal">

                        <div class="form-group">
                            <label for="nom_paciente" class="col-md-2 control-label">Nro De ficha</label>
                            <div class="col-md-10">
                                <input type="text" v-model="paciente.num_ficha" class="form-control">
                                <span v-if="formErrors['num_ficha']" class="error text-danger">
                                     {{ formErrors['num_ficha'] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nom_paciente" class="col-md-2 control-label">Nombre</label>
                            <div class="col-md-10">
                                <input type="text" v-model="paciente.nom_paciente" class="form-control">
                                <span v-if="formErrors['nom_paciente']" class="error text-danger">
                                     {{ formErrors['nom_paciente'] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ape_paciente" class="col-md-2 control-label">Apellidos</label>
                            <div class="col-md-10">
                                <input type="text" v-model="paciente.ape_paciente" class="form-control">
                                <span v-if="formErrors['ape_paciente']" class="error text-danger">
                                     {{ formErrors['ape_paciente'] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ape_paciente" class="col-md-2 control-label">Edad</label>
                            <div class="col-md-10">
                                 <input type="text" v-model="paciente.edad_paciente" class="form-control">
                                <span v-if="formErrors['edad_paciente']" class="error text-danger">
                                     {{ formErrors['edad_paciente'] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sexo" class="col-md-2 control-label">Género</label>
                            <div class="col-md-10">
                                <select id="sexo" v-model="paciente.sexo" class="form-control">
                                    <option value="M">Varon</option>
                                    <option value="F">Mujer</option>
                                </select>
                                <span v-if="formErrors['sexo']" class="error text-danger">
                                     {{ formErrors['sexo'] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-2">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Guardar<div class="ripple-container"></div></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>{{--cerrar div principal--}}


</template>

<script>
    import Paciente from './Paciente.vue';
    export default {
        data: function(){
            return {
                pacientes: [],
                paciente: {
                    nom_paciente: '',
                    ape_paciente: '',
                    edad_paciente: '',
                    sexo: ''
                },
                query : '',
                noresult: '',
                loading: false,
                formErrors:{},
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,

            }
        },
        components: {
            Paciente
        },
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        created: function ()
        {
            this.getPacientes(this.pagination.current_page);
        },
        methods: {
            getPacientes: function(page){
                this.$http.get('/pacientes?page='+page).then(function(response){
                   // console.log(response.data.data.data)
                    this.pacientes = response.data.data.data;
                    this.pagination = response.data.pagination;
                });
            },
            search: function() {
                // Clear the error message.
                this.noresult = '';
                // Empty the posts array so we can fill it with the new posts.
                this.posts = [];
                // Set the loading property to true, this will display the "Searching..." button.
                this.loading = true;
                if(this.query)
                {
                    this.$http.get('/pacientes/find?q=' + this.query).then(function(response) {
                        // If there was an error set the error message, if not fill the posts array.
                        console.log(response.data.error);
                        response.data.error ? this.noresult = response.data.error+' '+this.query : this.pacientes = response.data.data.data;
                        this.pagination = response.data.pagination;
                        // The request is finished, change the loading to false again.
                        this.loading = false;
                        // Clear the query.
                        this.query = '';
                    });
                }
                else{
                    this.noresult = 'Ingresar datos';
                    this.loading = false;
                }

            },
            createPaciente: function () {
                if(this.paciente.id != null)
                {
                    this.$http.put('pacientes/'+this.paciente.id, this.paciente).then(function(response){
                        this.getPacientes();
                        $("#create-paciente").modal('hide');
                        $('.modal-backdrop').remove();
                        this.paciente.num_ficha = '';
                        this.paciente.nom_paciente = '';
                        this.paciente.ape_paciente = '';
                        this.paciente.edad_paciente = '';
                        this.paciente.sexo = '';
                    }, function(response){
                           console.log('no entro')
                        }
                    );
                }else{
                    this.$http.post('/pacientes', this.paciente).then(function(response){
                        this.getPacientes();
                        $("#create-paciente").modal('hide');
                        $('.modal-backdrop').remove();
                        this.paciente.num_ficha = '';
                        this.paciente.nom_paciente = '';
                        this.paciente.ape_paciente = '';
                        this.paciente.edad_paciente = '';
                        this.paciente.sexo = '';

                    }, function (response) {
                        this.formErrors = response.body;
                    });
                }



            },
            changePage: function(page) {
                this.pagination.current_page = page;
                this.getPacientes(page);
            },
            deleteThisRow: function(index,paciente) {
                this.pacientes.splice(index, 1);
                console.log(paciente);
                this.$http.delete('/pacientes/' + paciente.id)

                // this.getPacientes();
            },
            editThisPaciente: function(index,paciente) {
                this.paciente.id = paciente.id;
                this.paciente.num_ficha = paciente.num_ficha;
                this.paciente.nom_paciente = paciente.nom_paciente;
                this.paciente.ape_paciente = paciente.ape_paciente;
                this.paciente.edad_paciente = paciente.edad_paciente;
                this.paciente.sexo = paciente.sexo;
            },

        }
    }
</script>