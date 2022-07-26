<template>
    <div>
        <div class='create_comment'>
            <form action="/posts/{{$post->id}}/comments/create" method="POST">
                @csrf
                <div>
                    <textarea name="comment[text]" placeholder="コメント"></textarea>
                    <p class="video__error" style="color:red">{{ $errors->first('post.video') }}</p>
                    <input type="submit" value="コメントを投稿"/>
                </div>
            </form>
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
    </div>
</template>
<script>
    export default {
        props: {
            post_id: Number,
        },
        data() {
            return {
                page: 0, // Offsetを指定するための変数
                comments: [], // 投稿を格納
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
            comment_delete(commnet_id) { // 投稿の削除
                if(confirm("削除しますか？")){
                    axios.request({
                        method: 'delete',
                        url: '/posts/' + commnet_id + '/delete'
                    })
                    .then((res) => {
                        console.log(post_id, '削除成功')
                        window.location.href = '/'; // 削除後にリダイレクト 
                    }, (error) => {
                        console.log(post_id, '削除失敗')
                    })
                }
            },
        }
    };
</script>