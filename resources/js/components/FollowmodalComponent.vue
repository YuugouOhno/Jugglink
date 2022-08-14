<template>
    <div v-show="auth_user">
        <p>
            <a v-on:click="openFollowingModal">{{followingCount}}フォロー</a>　
            <a v-on:click="openFollowedModal">{{followedCount}}フォロワー</a>
        </p>
        <div id="overlay_following" v-if="showFollowing" v-on:click="closeModal">
            <div id="content_following" v-on:click="stopEvent">
                <p class="follow_tab border_color_purple BG_color_lavender">フォロー</p>
                <a class="follow_tab border_color_purple" v-on:click="openFollowedModal">フォロワー</a>
                <div>
                    <Infinityusers ref="users" :following_id='user_id'></Infinityusers>
                </div>
            </div>
        </div>
        <div id="overlay_followed" v-if="showFollowed" v-on:click="closeModal">
            <div id="content_followed" v-on:click="stopEvent">
                <a class="follow_tab border_color_purple" v-on:click="openFollowingModal">フォロー</a>
                <p class="follow_tab border_color_purple BG_color_lavender">フォロワー</p>
                <div>
                    <Infinityusers ref="users" :followed_id='user_id'></Infinityusers>
                </div>
            </div>
            
        </div>
    </div>
</template>
<script>
    import Infinityusers from './InfinityusersComponent.vue';
    export default {
        props:{
            user_id: Number,
            followingCount: Number,
            followedCount: Number
        },
        components: {
            Infinityusers
        },
        data(){
            return{
                showFollowing: false,
                showFollowed: false,
                auth_user: "", // 認証データ
            }
        },
        mounted () {
            this.fetchAuth(); // 認証データ
        },
        methods:{
            fetchAuth() { // 認証データの取得
                axios.get('/infinityauth')
                .then(res => {
                    this.auth_user = res.data.auth_user; // resのdataのauth_user
                }).catch(function(error) {
                    console.log(error)
                });
            },
            openFollowingModal(){
                this.showFollowed = false;
                this.$nextTick(() => {
                    this.showFollowing = true;
                })
            },
            openFollowedModal(){
                this.showFollowing = false;
                this.$nextTick(() => {
                    this.showFollowed = true;
                })
            },
            closeModal(){
                this.showFollowing = false;
                this.showFollowed = false;
            },
            stopEvent(){
                event.stopPropagation()
            },
        }
    }
</script>