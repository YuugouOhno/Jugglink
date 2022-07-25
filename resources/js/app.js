/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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


Vue.component('like-component', require('./components/LikeComponent.vue').default);
Vue.component('bookmark-component', require('./components/BookmarkComponent.vue').default);
Vue.component('map-component', require('./components/MapComponent.vue').default);
Vue.component('posts-component', require('./components/PostsComponent.vue').default);
Vue.component('infinityposts-component', require('./components/InfinitypostsComponent.vue').default);
Vue.component('postmodal-component', require('./components/PostmodalComponent.vue').default);
Vue.component('profilemodal-component', require('./components/ProfilemodalComponent.vue').default);
Vue.component('menuemodal-component', require('./components/MenuemodalComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
