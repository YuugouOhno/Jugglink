<template>
    <div>
        <div v-for="user in users">
            <div class="user_container">
                <a class='color_black' :href="'/users/'+ user.id +'/profile/posts'">
                    <div class="user">
                        <img class="user_icon" :src="user.icon_path" v-if="user.icon_path">
                        <i class="fa-solid fa-circle-user user_icon" v-else></i>
                        <p class='user_name'>{{ user.name }}</p>
                    </div>
                </a>
            </div>
        </div>
        <infinite-loading @infinite="fetchUsers">
            <span slot="no-more"></span>
            <span slot="no-results">ユーザーは存在しません</span>
        </infinite-loading>
    </div>
</template>
<script>
    import InfiniteLoading from 'vue-infinite-loading'; // ライブラリの読み込み
    Vue.component('infinite-loading', InfiniteLoading); // コンポーネント化
    export default{
        props: {
            tool_id: Number,
            user_name: String,
            following_id: Number,
            followed_id: Number,
        },
        data(){
            return{
                page: 0,
                users: [],
                auth_user: ""
            }
        },
        mounted(){
            this.fetchAuth();
        },
        methods: {
            fetchAuth() { // 認証データの取得
                axios.get('/infinityauth')
                .then(res => {
                    this.auth_user = res.data.auth_user; // resのdataのauth_user
                }).catch(function(error) {
                    console.log(error)
                });
            },
            fetchedUserIdList() { // すでに取得したユーザーのIDリストを取得
                let fetchedUserIdList = [];
                for (let i = 0; i < this.users.length; i++) { // 取得してきたユーザーのデータ数でループ
                    fetchedUserIdList.push(this.users[i].id); // fetchedCommentIdListにユーザーのIDを追加
                }
                return fetchedUserIdList;
            },
            fetchUsers($state) {
                let fetchedUserIdList = this.fetchedUserIdList(); // すでに取得したユーザーのIDリストを取得
                axios.get('/infinity_user', { // コントローラーへ
                    params: {
                        fetchedUserIdList: JSON.stringify(fetchedUserIdList), // すでに取得したユーザーのIDリスト
                        page: this.page, // 現在のページ(読み込んだ回数)
                        tool_id: this.tool_id,
                        user_name: this.user_name,
                        following_id: this.following_id,
                        followed_id: this.followed_id
                    }
                })
                .then(response => {
                    if (response.data.users.length) { // ユーザーが存在するなら
                        this.page++; // 読み込んだ回数を増やす
                        response.data.users.forEach (value => {
                            this.users.push(value);
                        });
                        $state.loaded(); // まだ読み込める状態
                    } else { // ユーザーが存在しないなら
                        $state.complete(); // 終了
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>