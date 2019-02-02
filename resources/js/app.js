
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

Vue.component('student', require('./components/student.vue'));
Vue.component('activity', require('./components/activity.vue'));
Vue.component('schoolyear', require('./components/schoolyear.vue'));
Vue.component('activity-settings', require('./components/activity-settings.vue'));
Vue.component('attendance', require('./components/attendance.vue'));
Vue.component('manual-attendance', require('./components/manual-attendance.vue'));
Vue.component('attendance-list', require('./components/attendance-list.vue'));
Vue.component('summary-attendance', require('./components/summary-attendance.vue'));


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
