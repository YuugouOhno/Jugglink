<template>
    <div>
        <div class='create_comment'>
            <div　class="comment_box">
                <div class="text">
                    <textarea v-model="text" placeholder="コメント欄"></textarea>
                </div>
            </div>
            <button class="BG_color_purple color_white" v-on:click="comment()">送信</button>
        </div>
        <div v-for="comment in comments">
            <div class="comment_container">
                <div class="comment_user">
                    <a class='color_black' v-bind:href="'/users/' + comment.user_id + '/profile/posts'">
                        <div class="comment_user_icon" v-if="comment.user.icon_path === null">
                            <i class="fa-solid fa-circle-user"></i>
                        </div>
                        <div class="comment_user_icon" v-else>
                            <img :src=comment.user.icon_path>
                        </div>
                        <p class='comment_user_name'>{{ comment.user.name }}</p>
                    </a>
                    <div class='reaction_icon delete_btn comment_delet' v-if="comment.user.id === auth_user.id">
                        <button class='btn' v-on:click="commnet_delete(comment.id)">
                            <i class="fa-regular fa-trash-can color_gray"></i>
                        </button>
                    </div>
                </div>
                <div class='comment_text'>
                    <p>{{ comment.text }}</p>
                </div>
            </div>
        </div>
        <infinite-loading @infinite="fetchComments">
            <span slot="no-more"></span>
            <span slot="no-results">コメントは存在しません</span>
        </infinite-loading>
    </div>
</template>
<script>
    import InfiniteLoading from 'vue-infinite-loading'; // ライブラリの読み込み
    Vue.component('infinite-loading', InfiniteLoading); // コンポーネント化
    export default {
        props: {
            post_id: Number,
        },
        data() {
            return {
                page: 0, // Offsetを指定するための変数
                comments: [], // 投稿を格納
                auth_user: "", // 認証データ
                text: ''
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
                    this.fetchComments();
                }).catch(function(error) {
                    console.log(error)
                });
            },
            comment_delete(commnet_id) { // 　コメントの削除
                axios.request({
                    method: 'delete',
                    url: 'comments/' + commnet_id + '/delete'
                })
                .then((res) => {
                    this.comments.splice(0); // コメントの先頭に戻って
                    this.page=0; // 読み込みをリセットして
                    this.$nextTick(() => {
                        this.fetchComments(); // コメントを読み込み
                    })
                }, (error) => {
                    console.log(error)
                })
            },
            comment() { // コメント
                //formDataをnewする
                let formData = new FormData();
                //appendでデータを追加(第一引数は任意のキー)
                //他に送信したいデータがある場合にはその分appendする
                formData.append('text', this.text);
                formData.append('post_id', this.post_id);
          	    axios.post('/posts/comments/create', formData)
                .then(response => {
                    window.location.href = '/'; // 削除後にリダイレクト 
                    this.text=""; // 入力欄をリセット
                    this.comments.splice(0); // コメントの先頭に戻って
                    this.page=0; // 読み込みをリセットして
                    this.$nextTick(() => {
                        this.fetchComments(); // コメントを読み込み
                    })
                })
                .catch(error => {
                    console.log(error);
                })
            },
            fetchedCommentIdList() { // すでに取得したコメントのIDリストを取得
                let fetchedCommentIdList = [];
                for (let i = 0; i < this.comments.length; i++) { // 取得してきたコメントのデータ数でループ
                    fetchedCommentIdList.push(this.comments[i].id); // fetchedCommentIdListにコメントのIDを追加
                }
                return fetchedCommentIdList;
            },
            fetchComments($state) {
                let fetchedCommentIdList = this.fetchedCommentIdList(); // すでに取得したコメントのIDリストを取得
                axios.get('/infinity_comment', { // コントローラーへ
                    params: {
                        fetchedCommentIdList: JSON.stringify(fetchedCommentIdList), // すでに取得したコメントのIDリスト
                        page: this.page, // 現在のページ(読み込んだ回数)
                        post_id: this.post_id,
                    }
                })
                .then(response => {
                    if (response.data.comments.length) { // コメントが存在するなら
                        this.page++; // 読み込んだ回数を増やす
                        response.data.comments.forEach (value => {
                            this.comments.push(value);
                        });
                        $state.loaded(); // まだ読み込める状態
                    } else { // コメントが存在しないなら
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