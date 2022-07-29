<template>
    <div>
        <a v-on:click="openModal" class='comment_btn'>
            コメントのモーダル
            <!--<i class="fa-regular fa-comment color_black"></i>-->
        </a>
        <div id="overlay_comment" v-show="showContent" v-on:click='closeModal'>
            <div id="content_comment" class="modal_content" v-on:click="stopEvent">
                <!--<div>-->
                <!--    <Comment :post_id="post_id"></Comment>-->
                <!--</div>-->
                
            </div>
        </div>
    </div>
</template>
<script>
    //import Comment from './CommentComponent.vue'; // コメント機能の読み込み
    export default {
        // components: { // 読み込むコンポーネントの指定
        //     Comment
        // },
        data() {
            return {
                showContent: false,
                showContent: "",
                //post_id:  Number
            }
        },
        methods:{
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
#overlay_comment{
  /*　要素を重ねた時の順番　*/
  z-index:300;

  /*　画面全体を覆う設定　*/
  background-color:rgba(0,0,0,0.5);
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
}

#content_comment{
  z-index:301;
  background-color:white;
  padding: 1em;
  margin:0;
  position:absolute;
  top:20px;
  left:0px;
  height:60%;
  width:50%
  
}
</style>