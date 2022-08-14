<template>
    <div>
        <a v-on:click="openModal" class='menue_btn' v-show="showMenueButton">
            <i class="fa-solid fa-bars color_white"></i>
        </a>
        <div id="overlay_menue" v-show="showContent" v-on:click='showMenueButton ? closeModal() : ""'>
            <div id="content_menue" class="modal_content" v-on:click="stopEvent">
                <div class="mene_close_button">
                        <button class="btn" v-on:click="closeModal">
                            <i class="fa-solid fa-xmark close_btn color_black"></i>
                        </button>
                    </div>
                <div class='menues BG_color_white'>
                    <div class='menue btnBox l_icon'>
                        <a class='color_black' :href="'/'">
                            <img class="Jugglink_l menue_text" :src="'https://jugglinkbucket.s3.amazonaws.com/jugglink_icon/l.PNG'">
                            <img class="miniJugglink_l" :src="'https://jugglinkbucket.s3.amazonaws.com/jugglink_icon/minil.PNG'">
                        </a>
                    </div>
                    
                    <div class='menue btnBox'>
                        <a class='color_black' :href="'/'">
                            <i class="fa-solid fa-house-chimney"></i>
                            <p class="menue_text">ホーム</p>
                        </a>
                    </div>
                    <div class='menue btnBox'>
                        <a class="color_black serch" :href="'/search/index/technique/'">
                            <i class="fa-solid fa-magnifying-glass"></i><p class="menue_text">検索</p>
                        </a>
                    </div>
                    <div class='menue btnBox'>
                        <a class='color_black' :href="'/users/'+auth_user.id+'/profile/posts'">
                            <i class="fa-solid fa-address-card"></i><p class="menue_text">プロフィール</p>
                        </a>
                    </div>
                    <div class='menue btnBox'>
                        <a class='color_black' :href="'/bookmarks/'+auth_user.id+'/posts'">
                            <i class="fa-solid fa-bookmark"></i><p class="menue_text">ブックマーク</p>
                        </a>
                    </div>
                    <div class='menue btnBox'>
                        <a class='color_black' :href="'/map'">
                            <i class="fa-solid fa-map-location-dot"></i><p class="menue_text">ジャグラー分布</p>
                        </a>
                    </div>
                </div>
                <div class='create_post btnBox'>
                    <div class='modaldada'>
                        <postmodal></postmodal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Postmodal from './PostmodalComponent.vue'; // ブックマーク機能の読み込み
    export default {
        components: { // 読み込むコンポーネントの指定
            Postmodal
        },
        data() {
            return {
                showMenueButton: "",
                showContent: "",
                auth_user: []
            }
        },
        mounted () {
            this.fetchAuth(); // 認証データ
            window.addEventListener('resize', this.newWindowWidth);
            this.nowWindowWidth();
        },
        methods:{
            fetchAuth() { // 認証データの取得
                axios.get('/infinityauth')
                .then(res => {
                    this.auth_user = res.data.auth_user; // resのdataのauth_user
                    console.log(res.data.auth_user,"Authの中身どや")
                    console.log(this.auth_user.tool.id,"Authの中身どや")
                    this.selectTool = this.auth_user.tool.id;
                    this.introduce = this.auth_user.introduce;
                    this.name = this.auth_user.name;
                }).catch(function(error) {
                    console.log("Authの取得失敗")
                });
            },
            nowWindowWidth(){
                if(window.innerWidth>=520){
                    this.showMenueButton = false;
                    this.showContent = true;
                }else{
                    this.showMenueButton = true;
                    this.showContent = false;
                }
            },
            newWindowWidth() {
                this.windowWidth = window.innerWidth;
                // console.log(this.windowWidth);
                if(window.innerWidth>=520){
                    this.showMenueButton = false;
                    this.showContent = true;
                }else{
                    this.showMenueButton = true;
                    this.showContent = false;
                }
            },
            openModal(){
                this.showContent = true
            },
            closeModal(){
                this.showContent = false
            },
            stopEvent(){
                event.stopPropagation()
            }
        }
    }
</script>