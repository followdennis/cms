

export default[
    { path: '', redirect: '/index' },
    { path: '/index', component: require('./../page/App.vue') },
    { path: '/newslist', component: require('./../page/List.vue') },
    { path: '/newsdetail/:id', component: require('./../page/Detail.vue') }
];