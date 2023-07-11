import Vue from 'vue';
import Index from './Index.vue';
import General from './General.vue';
import FormFields from './FormFields.vue';
import ContactButton from './ContactButton.vue';
import SubmitButton from './SubmitButton.vue';
// import SuccessNotice from './SuccessNotice.vue';
// import WaitingNotice from './WaitingNotice.vue';
// import ErrorNotice from './ErrorNotice.vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const routes = [
    { path: '/', component: General },
    { path: '/general', component: General },
    { path: '/form-fields', component: FormFields },
    { path: '/contact-button', component: ContactButton },
    { path: '/submit-button', component: SubmitButton },
    // { path: '/success-notice', component: SuccessNotice },
    // { path: '/waiting-notice', component: WaitingNotice },
    // { path: '/error-notice', component: ErrorNotice },
]

const router = new VueRouter({routes})


new Vue({
    el: '#affpro-admin',
    render: h => h(Index),
    router: router
    // components: { App }
});