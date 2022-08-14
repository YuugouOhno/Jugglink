<template>
    <div>
        <div class="reaction_icon comment_btn comment_modal_btn">
            <a v-on:click="openModal" class='btn'>
                <i class="fa-regular fa-comment color_black"></i>
            </a>
        </div>
        <div id="content_comment" class="modal_content right_container BG_color_white" v-show="showContent">
            <h3>{{post.tool_number}}{{post.tool.tool_name}}{{post.technique}}</h3>
            <div>
                <infinitycomments :post_id="post.id"></infinitycomments>
            </div>
            
        </div>
    </div>
</template>
<script>
    import Infinitycomments from './InfinitycommentsComponent.vue'; // コメント機能の読み込み
    export default {
        props: {
            post: [],
        },
        components: { // 読み込むコンポーネントの指定
            Infinitycomments
        },
        data() {
            return {
                showContent: false,
                showContent: "",
            }
        },
        methods:{
            openModal(){
                this.showContent = false
                this.$nextTick(() => {
                    this.showContent = true
                })
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