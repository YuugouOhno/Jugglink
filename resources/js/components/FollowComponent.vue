<template>
    <div>
        <div class="folowing_followed">
            <followmodal :user_id="this.user_id" :followingCount="followingCount" :followedCount="followedCount"></followmodal></followmodal>
        </div>
        <div v-show="!(user_id===auth_user.id)" class="following_btn">
            <button v-if="result" type="button" class="unfollow_btn" @click="unfollow()">
                <span class="unfollow_btn_nomal color_purple"><i class="mr-1 fas fa-user-check"></i>フォロー中</span>
                <span class="unfollow_btn_hover color_red">フォロー解除</span>
            </button>
            <button  v-else type="button" class="follow_btn BG_color_black color_white" @click="follow()"><i class="mr-1 fas fa-user-plus color_white"></i>フォロー</button>
        </div>
    </div>
</template>

<script>
    import Followmodal from './FollowmodalComponent.vue';
    export default {
        components: {
            Followmodal
        },
        props:{
            user_id: Number,
        },
        data() {
            return{
                result: "",
                followedCount: 0,
                followingCount: 0,
                auth_user: "", // 認証データ
            };
        },
        mounted () {
            this.hasfollowed();
            this.countfollows();
            this.fetchAuth(); // 認証データ
        },
        methods: {
            fetchAuth() { // 認証データの取得
                axios.get('/infinityauth')
                .then(res => {
                    this.auth_user = res.data.auth_user; // resのdataのauth_user
                }).catch(function(error) {
                    console.log(error);
                });
            },
            follow() {
                axios.get('/users/' + this.user_id + '/follow')
                .then(res => {
                    this.result = res.data.result;
                    this.followedCount = res.data.followedCount;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            unfollow() {
                axios.delete('/users/' + this.user_id + '/unfollow')
                .then(res => {
                    this.result = res.data.result;
                    this.followedCount = res.data.followedCount;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            countfollows() {
                axios.get('/users/' + this.user_id +'/countfollows')
                .then(res => {
                    this.followedCount = res.data.followedCount;
                    this.followingCount = res.data.followingCount;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            hasfollowed() {
                axios.get('/users/' + this.user_id +'/hasfollowed')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
