<template>
    <div>
        <div class='create_comment'>
            <button class="BG_color_purple color_white" v-on:click="comment()">送信</button>
            <div　class="comment_box">
                <p class="comment_label">コメント</p>
                <div class="text">
                    <textarea v-model="text" placeholder="コメント欄"></textarea>
                </div>
            </div>
        </div>
        <div v-for="comment in comments">
            <div>
                <a class='color_black' v-bind:href="'/users/' + comment.user_id + '/profile/posts'">
                    <div class="user">
                        <div v-if="comment.user.icon_path === null">
                            <i class="fa-solid fa-circle-user user_icon"></i>
                        </div>
                        <div v-else>
                            <img class="user_icon" :src=comment.user.icon_path>
                        </div>
                        <p class='user_name'>{{ comment.user.name }}</p>
                    </div>
                </a>
            </div>
            <div>
                <p>{{ comment.text }}</p>
            </div>
            <div class='reaction_icon delete_btn' v-if="comment.user.id === auth_user.id">
                <button v-on:click="commnet_delete(comment.id)" class='btn'>
                    <i class="fa-regular fa-trash-can color_gray"></i>
                </button>
            </div>
        </div>
        <infinite-loading @infinite="fetchComments"></infinite-loading>
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
                    console.log(res.data,"Authの中身")
                    console.log(this.url,"URLの中身")
                }).catch(function(error) {
                    console.log(this.auth_user,"Authの取得失敗")
                });
            },
            comment() {
                //formDataをnewする
                let formData = new FormData();
                //appendでデータを追加(第一引数は任意のキー)
                //他に送信したいデータがある場合にはその分appendする
                formData.append('text', this.text);
                formData.append('post_id', this.post_id);
                console.log(this.fileData)
                console.log(this.text);
          	    axios.post('/posts/comments/create', formData)
                .then(response => {
                    console.log("成功");
                    //window.location.href = '/'; // 削除後にリダイレクト 
                    this.text="";
                    this.comments.splice(0);
                    this.page=0;
                    this.$nextTick(() => {
                      this.fetchComments();
                    })
                    
                    
                })
                .catch(error => {
                    console.log(error);
                })
            },
            comment_delete(commnet_id) { // コメントの削除
                if(confirm("削除しますか？")){
                    axios.request({
                        method: 'delete',
                        url: '/posts/comments/' + commnet_id + '/delete'
                    })
                    .then((res) => {
                        console.log(post_id, '削除成功')
                    }, (error) => {
                        console.log(post_id, '削除失敗')
                    })
                }
            },
            fetchedCommentIdList() { // すでに取得した投稿のIDリストを取得
                let fetchedCommentIdList = [];
                for (let i = 0; i < this.comments.length; i++) { // 取得してきたコメントのデータ数でループ
                    fetchedCommentIdList.push(this.comments[i].id); // fetchedCommentIdListにコメントのIDを追加
                }
                return fetchedCommentIdList;
            },
            fetchComments($state) {
                console.log("コメントの無限");
                let fetchedCommentIdList = this.fetchedCommentIdList(); // すでに取得した投稿のIDリストを取得
                axios.get('/infinity_comment', { // コントローラーへ
                    params: {
                        fetchedCommentIdList: JSON.stringify(fetchedCommentIdList), // すでに取得した投稿のIDリスト
                        page: this.page, // 現在のページ(読み込んだ回数)
                        post_id: this.post_id,
                    }
                })
                .then(response => {
                    if (response.data.comments.length) { // 投稿データが存在するなら
                        this.page++; // 読み込んだ回数を増やす
                        response.data.comments.forEach (value => {
                            this.comments.push(value);
                        });
                        console.log(this.comments,"commentsの中身");
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