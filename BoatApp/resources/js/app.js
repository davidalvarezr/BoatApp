/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import PersonalAccessTokens from "./components/passport/PersonalAccessTokens";
import TokenSetter from "./components/auth/TokenSetter";
import Boat from "./components/boat/Boat";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import BoatList from "./components/boat/BoatList";


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

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.component('personnal-access-token', PersonalAccessTokens);
Vue.component('token-setter', TokenSetter);
Vue.component('boat', Boat);
Vue.component('boat-list', BoatList)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.defaults.headers.common = {
    'Authorization': `Bearer ${localStorage.access_token}`,
    'Accept': 'application/json',
}
Vue.prototype.$axios = axios

const app = new Vue({
    el: '#app',
});
