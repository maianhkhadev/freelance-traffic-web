
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

Vue.component('flatpickr', require('./components/flatpickr.vue').default);
Vue.component('chart-bar-members', require('./components/chart-bar-members.vue').default);
Vue.component('chart-pie-projects', require('./components/chart-pie-projects.vue').default);
Vue.component('chart-pie-teams', require('./components/chart-pie-teams.vue').default);
Vue.component('chart-member', require('./components/chart-member.vue').default);
Vue.component('chart-timeline', require('./components/chart-timeline.vue').default);
Vue.component('field-search', require('./components/field-search.vue').default);
Vue.component('field-task-name', require('./components/field-task-name.vue').default);
Vue.component('status-closed', require('./components/status-closed.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
