/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('formulario1-component', require('./components/Formulario1Component.vue').default);
Vue.component('formulario2-component', require('./components/Formulario2Component.vue').default);
Vue.component('formulario3-component', require('./components/Formulario3Component.vue').default);
Vue.component('formulario4-component', require('./components/Formulario4Component.vue').default);
Vue.component('formulario5-component', require('./components/Formulario5Component.vue').default);
Vue.component('consulta-component', require('./components/ConsultaComponent.vue').default);
Vue.component('cliente-component', require('./components/ClienteComponent.vue').default);
Vue.component('historiaclinica-component', require('./components/HistoriaclinicaComponent.vue').default);
Vue.component('detalleatencion-component', require('./components/DetalleatencionComponent.vue').default);
Vue.component('pacientecama-component', require('./components/PacientecamaComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
const app1 = new Vue({
    el: '#app1',
});

const app2 = new Vue({
    el: '#app2',
});

const app3 = new Vue({
    el: '#app3',
});

const app4 = new Vue({
    el: '#app4',
});

const app5 = new Vue({
    el: '#app5',
});

const app6 = new Vue({
    el: '#app6',
});
const app7 = new Vue({
    el: '#app7',
});

const app8 = new Vue({
    el: '#app8',
});

const app9 = new Vue({
    el: '#app9',
});

const app10 = new Vue({
    el: '#app10',
});

