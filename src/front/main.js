import Vue from 'vue';
import App from './App.vue';

document.body.innerHTML += '<div id="wff-app"></div>';

new Vue({
    el: '#wff-app',
    render: h => h(App),
    // components: { App }
});