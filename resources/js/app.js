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


Vue.component('like-component', require('./components/LikeComponent.vue').default); // いいね
Vue.component('bookmark-component', require('./components/BookmarkComponent.vue').default); // ブックマーク
Vue.component('map-component', require('./components/MapComponent.vue').default); // ジャグラー分布
Vue.component('infinityposts-component', require('./components/InfinitypostsComponent.vue').default); // 投稿の無限スクロール
Vue.component('postmodal-component', require('./components/PostmodalComponent.vue').default); // 投稿のモーダル表示
Vue.component('profilemodal-component', require('./components/ProfilemodalComponent.vue').default); // プロフィール編集のモーダル表示
Vue.component('menuemodal-component', require('./components/MenuemodalComponent.vue').default); // メニューのモーダル表示
Vue.component('commentmodal-component', require('./components/CommentmodalComponent.vue').default); // コメントの非同期処理
Vue.component('follow-component', require('./components/FollowComponent.vue').default); // フォロー
Vue.component('followmodal-component', require('./components/FollowmodalComponent.vue').default); // FFリストのモーダル表示
Vue.component('infinitycomments-component', require('./components/InfinitycommentsComponent.vue').default); // コメントの無限スクロール
Vue.component('infinityusers-component', require('./components/InfinityusersComponent.vue').default); // ユーザーの無限スクロール
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
