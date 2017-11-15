
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('eventtest',require('./components/event.vue'));
Vue.component('todo-item',{
   props:['todo'],
    template:'<li>{{ todo.text }}</li>'

});
Vue.component('user-form',require('./components/Form.vue'));
import ElementUI from 'element-ui'    //引入element－ui
import 'element-ui/lib/theme-default/index.css' //引入element－ui所需的css样式资源文件
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import axios from 'axios'


const Foo = {template:'<div>foo</div>'};
const Bar = {template:'<div>bar</div>'};

const routes = [
    {path:'/foo',component:Foo},
    {path:'/bar',component:Bar}
];
const router = new VueRouter({
    mode:'history',
    routes
});


Vue.use(VueResource);
Vue.use(ElementUI);    //把引入的ElementUI装入我们的Vue
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    router,
    data:{
        groceryList:[
            {id:0,text:'蔬菜'},
            {id:1,text:'大西瓜'},
            {id:3,text:'奶酪'}
        ]
    }
});
