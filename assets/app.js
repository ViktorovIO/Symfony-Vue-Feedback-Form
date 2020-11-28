/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import './styles/app.sass';

import Vue from 'vue';
import router from "./router/index";
import Index from './components/Index';
import store from "./store";

new Vue({
    el: '#app',
    components: { Index },
    template: "<Index/>",
    router,
    store
}).$mount("#app");