<template>
    <div>
        <a v-on:click="openModal" class='comment_btn'>
            <i class="fa-regular fa-comment color_black"></i>
        </a>
        <div id="overlay_comment" v-on:click='closeModal'>
            <div id="content_comment" class="modal_content" v-on:click="stopEvent">
                <div>
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import CommentModal from './CommentmodalComponent.vue'; // ブックマーク機能の読み込み
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
<style>
#overlay_menue{
  /*　要素を重ねた時の順番　*/
  z-index:2;

  /*　画面全体を覆う設定　*/
  
  position:fixed;
  top:0;
  left:0;
  width:100%;
}

#content_menue{
  z-index:3;
  padding: 1em;
  margin:0;
  position:absolute;
  top:20px;
  left:0px;
  height:100%;
}

.menue a{
    padding:10px;
    border-radius:10px;
}

.menue a:hover{
    border: 1px solid #65318e; /*紫*/
}

.Jugglink_l{
    height:50px;
    width:auto;
}

.miniJugglink_l{
    padding:0;
    height:50px;
    width:auto;
}

.mene_close_button{
    display:none;
}

/*1170px以上(パソコン用)*/
@media(min-width:1170px){
    #overlay_menue{
        height:0%;
    }
    
    #content_menue {
        width:25%;
    }
}
    
/*1170px以下(パソコン用)*/
@media(max-width:1170px){
    #overlay_menue{
        height:0%;
    }
    #content_menue {
        width:30%;
    }
}

/*960px以下(タブレット用)*/
@media(max-width:960px){
    #overlay_menue{
        height:0%;
    }
    #content_menue {
        width:20%;
    }
}
    
/*520px以下(スマホ用)*/
@media(max-width:520px){
    #overlay_menue{
        height:100%;
    }
    #content_menue {
        top:0;
        width:70%;
        background-color:#e7e7eb;/*白*/
        border: 1px solid #65318e; /*紫*/
    }
    .mene_close_button{
        display:inline;
    }
}
    
</style>