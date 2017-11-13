import Vue from 'vue/dist/vue.js';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import App from './App.vue';
import mainPage from './components/mainpage/mainpage.vue';
Vue.use(VueRouter);
Vue.use(VueResource);

const routes = [
    { path: '/main', component: mainPage },
];
const router = new VueRouter({
    routes,
    linkActiveClass: 'active'
});
new Vue(Vue.util.extend({ router }, App)).$mount('#app')
router.push('/main');