import Vue from "vue";
import VueRouter from "vue-router";

// 引入组件
import home from "./components/home/home.vue";
import about from "./components/home/about.vue";

// 要告诉 vue 使用 vueRouter
Vue.use(VueRouter);

const routes = [
    {
        path:"/home",
        component: home
    },
    {
        path: "/about",
        component: about
    },
    {
        path:'/',
        redirect:'/home'
    }
]

var router =  new VueRouter({
    routes
})
export default router;