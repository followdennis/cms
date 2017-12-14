require('./bootstrap');

window.Vue = require('vue');

import App from './App.vue';
import ElementUI from 'element-ui'    //引入element－ui
import 'element-ui/lib/theme-default/index.css' //引入element－ui所需的css样式资源文件
Vue.use(ElementUI);

import router from './router/index.js';

const app = new Vue({
        el: '#app',
        router,
        render: h => h(App)
});