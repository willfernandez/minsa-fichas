
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

//
Vue.component('example', require('./components/Example.vue'))
Vue.component('Pacientes', require('./components/Pacientes.vue'))
Vue.component('v-categoria', require('./components/Categoria.vue'))
Vue.component('v-incidente', require('./components/TipoIncidente.vue'))
Vue.component('v-evento', require('./components/TipoEvento.vue'))
Vue.component('v-navbar', require('./components/layout/Navbar.vue'))

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue';

// Globally register bootstrap-vue components
Vue.use(BootstrapVue);

var app = new Vue({
    el: '#app',
});
