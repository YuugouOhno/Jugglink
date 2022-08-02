<template>
    <div class="contents">
        <div v-for="post in posts">
            <div class='post_container'>
                <div>
                    <a class='color_black' v-bind:href="'/users/' + post.user_id + '/profile/posts'">
                        <div class="user">
                            <div v-if="post.user.icon_path === null">
                                <i class="fa-solid fa-circle-user user_icon"></i>
                            </div>
                            <div v-else>
                                <img class="user_icon" :src=post.user.icon_path>
                            </div>
                            <p class='user_name'>{{ post.user.name }}</p>
                        </div>
                    </a>
                </div>
                <div class='video'>
                    <video controls loop autoplay muted>
                        <source :src=post.video_path>
                    </video>
                </div>
                <div class='post_titles'>
                    <p class='tool_number post_title color_black'>{{ post.tool_number }}</p>
                    <a class='tool_name post_title color_purple'  v-bind:href="'/tools/' + post.tool_id">{{ post.tool.tool_name }}</a>
                    <p class='technique_name post_title color_black'>{{ post.technique }}</p>
                </div>
                <div class='post_text'>
                    <p class='color_black'>{{ post.text }}</p>
                </div>
                <div class='post_reaction'>
                    <div class='reaction_icon like_btn'>
                        <Like :post_id='post.id'></Like>
                    </div>
                    <div class='reaction_icon comment_btn comment_nomal_btn'>
                        <a :href="'/posts/' + post.id + '/comments'" class='btn'>
                            <i class="fa-regular fa-comment color_black"></i>
                        </a>
                    </div>
                    <div>
                        <Commentmodal :post="post"></Commentmodal>
                    </div>
                    <div class='reaction_icon bookmark_btn'>
                        <Bookmark :post_id='post.id'></Bookmark>
                    </div>
                    <div class='reaction_icon delete_btn' v-if="post.user.id === auth_user.id">
                        <button v-on:click="post_delete(post.id)" class='btn'>
                            <i class="fa-regular fa-trash-can color_gray"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <infinite-loading @infinite="fetchPosts">
            <span slot="no-more"></span>
            <span slot="no-results">投稿は存在しません</span>
        </infinite-loading>
    </div>
</template>
<script>
    import InfiniteLoading from 'vue-infinite-loading'; // ライブラリの読み込み
    Vue.component('infinite-loading', InfiniteLoading); // コンポーネント化
    import Like from './LikeComponent.vue';// いいね機能の読み込み
    import Bookmark from './BookmarkComponent.vue'; // ブックマーク機能の読み込み
    import Commentmodal from './CommentmodalComponent.vue'; // コメント機能の読み込み
    
    export default {
        props: {
            technique: String,
            tool_id: Number,
            tool_number: Number,
            user_id: Number,
            like_id: Number,
            bookmark_id: Number,
        },
        components: { // 読み込むコンポーネントの指定
            Like,
            Bookmark,
            Commentmodal
        },
        data() {
            return {
                page: 0, // Offsetを指定するための変数
                posts: [], // 投稿を格納
                auth_user: "", // 認証データ
            }
        },
        mounted () {
            this.fetchAuth(); // 認証データ
        },
        methods: {
            fetchAuth() { // 認証データの取得
                axios.get('/infinityauth')
                .then(res => {
                    this.auth_user = res.data.auth_user; // resのdataのauth_user
                    console.log(res.data,"Authの中身")
                    console.log(this.url,"URLの中身")
                }).catch(function(error) {
                    console.log(this.auth_user,"Authの取得失敗")
                });
            },
            post_delete(post_id) { // 投稿の削除
                if(confirm("削除しますか？")){
                    axios.request({
                        method: 'delete',
                        url: '/posts/' + post_id + '/delete'
                    })
                    .then((res) => {
                        console.log(post_id, '削除成功')
                        window.location.href = '/'; // 削除後にリダイレクト 
                    }, (error) => {
                        console.log(post_id, '削除失敗')
                    })
                }
            },
            fetchedPostIdList() { // すでに取得した投稿のIDリストを取得
                let fetchedPostIdList = [];
                for (let i = 0; i < this.posts.length; i++) { // 取得してきた投稿のデータ数でループ
                    fetchedPostIdList.push(this.posts[i].id); // fetchedPostIdListに投稿のIDを追加
                }
                return fetchedPostIdList;
            },
            fetchPosts($state) {
                let fetchedPostIdList = this.fetchedPostIdList(); // すでに取得した投稿のIDリストを取得
                console.log(this.technique, this.tool_id, this.tool_number, "パラメータ")
                axios.get('/infinity', { // コントローラーへ
                    params: {
                        fetchedPostIdList: JSON.stringify(fetchedPostIdList), // すでに取得した投稿のIDリスト
                        page: this.page, // 現在のページ(読み込んだ回数)
                        technique: this.technique,
                        tool_id: this.tool_id,
                        tool_number: this.tool_number,
                        user_id: this.user_id,
                        like_id: this.like_id,
                        bookmark_id: this.bookmark_id,
                    }
                })
                .then(response => {
                    if (response.data.posts.length) { // 投稿データが存在するなら
                        this.page++; // 読み込んだ回数を増やす
                        response.data.posts.forEach (value => {
                            this.posts.push(value);
                        });
                        console.log(this.posts,"postsの中身");
                        $state.loaded(); // まだ読み込める状態
                    } else { // 投稿データが存在しないなら
                        console.log("おしまい");
                        $state.complete(); // 終了
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    };
</script>