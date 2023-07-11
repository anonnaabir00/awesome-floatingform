import Vue from 'vue';
import App from './App.vue';

document.body.innerHTML += '<div id="affpro-app"></div>';

new Vue({
    el: '#affpro-app',
    render: h => h(App),
    // components: { App }
});