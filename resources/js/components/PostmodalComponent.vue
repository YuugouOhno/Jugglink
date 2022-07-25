<template>
    <div>
        <div class="menue btnBox">
            <a v-on:click="openModal" class='color_black'>
                <i class="fa-solid fa-square-plus"></i><p class="menue_text">投稿</p>
            </a>
        </div>
        <div id="overlay_post" v-show="showContent" v-on:click="closeModal">
            <div id="content_post" class="modal_content BG_color_white" v-on:click="stopEvent">
                    <div class="edit_button">
                        <button class="btn" v-on:click="closeModal">
                            <i class="fa-solid fa-xmark close_btn color_black"></i>
                        </button>
                        <button class="edit_btn BG_color_purple color_white" v-on:click="post()">投稿</button>
                    </div>
                    
                    <div class="post_header">
                        <h5>新規投稿の作成</h5>
                    </div>
                    
                    <div class="preview_container border_color_purple">
                        <div class="preview_video">
                            <div v-if="url">
                                <video controls loop autoplay muted>
                                    <source :src="url" type="video/mp4">
                                </video>
                            </div>
                            <div v-else>
                                <p>プレビュー</p>
                            </div>
                        </div>
                        <div class="preview_post_title">
                            <p>{{selectNumber}}</p>
                            <p>{{selectTool}}</p>
                            <p>{{technique}}</p>
                        </div>
                        <div class="preview_post_text">
                            <p>{{text}}</p>
                        </div>
                    </div>
                    
                    <div class="post_box">
                        <p class="post_label"></p>
                        <div v-if="radioValue">
                            <input type="radio" v-model="radioValue" value="technique" @change="selectTechnique"> 技
                    	    <input type="radio" v-model="radioValue" value="sequence" @change="selectSequence"> シークエンス
                        </div>
                        <div v-else>
                            <input type="radio" v-model="radioValue" value="technique" @change="selectTechnique"> 技
                    	    <input type="radio" v-model="radioValue" value="sequence" @change="selectSequence"> シークエンス
                    	    <p class="color_red">どちらかを選択してください。</p>
                        </div>
                    </div>
                    
                    <div class="post_video post_box">
                        <p class="post_label">動画</p>
                        <div class="color_black BG_color_lavender border_color_purple" v-if="fileData">
                            <label>
                                <input type='file' ref="preview" @change="handleFile" name="file">選択済み
                            </label>
                        </div>
                        <div v-else>
                            <div class="color_black BG_color__white border_color_red">
                                <label>
                                    <input type='file' ref="preview" @change="handleFile" name="file">ファイルを選択してください
                                </label>
                            </div>
                            <p class="color_red">動画は必須項目です。</p>
                        </div>
                    </div>
                    
                	<div class="post_tool post_box">
                	    <p class="post_label">道具</p>
                	    <div v-if="selectTool">
                	        <select class="border_color_purple BG_color_lavender" v-model="selectTool">
                        	    <option disabled value="">道具を選択</option>
                        		<option v-for="tool in tools" :key="tool.id" :value="tool.tool_name">
                                    {{ tool.tool_name }}
                                </option>
                        	</select>
                	    </div>
                    	<div v-else>
                    	    <select class="border_color_red" v-model="selectTool">
                        	    <option disabled value="">道具を選択</option>
                        		<option v-for="tool in tools" :key="tool.id" :value="tool.tool_name">
                                    {{ tool.tool_name }}
                                </option>
                        	</select>
                        	<p class="color_red">道具は必須項目です。</p>
                    	</div>
                    </div>
                    
                	<div class="post_toolnumber post_box">
                	    <p class="post_label">道具数</p>
                	    <div v-if="selectNumber">
                	        <select class="border_color_purple BG_color_lavender" v-model="selectNumber">
                                <option disabled value="">道具数を選択</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                	    </div>
                        <div v-else>
                            <select class="border_color_red" v-model="selectNumber">
                        	    <option disabled value="">道具数を選択</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                        	</select>
                        	<p class="color_red">道具数は必須項目です。</p>
                        </div>
                    </div>
                    
                    <div class="post_technique post_box" v-if="radioValue==='technique'">
                        <p class="post_label">技名</p>
                        <div v-if="technique">
                            <input type='text' class="border_color_purple BG_color_lavender" v-model="technique" placeholder="技名を入力">
                        </div>
                        <div v-else>
                            <input type='text' class="border_color_red" v-model="technique" placeholder="技名を入力">
                            <p style="color:red">技名は必須項目です。</p>
                        </div>
                    </div>
                    
                    
                    <div　class="post_box">
                        <p class="post_label">コメント</p>
                        <div class="text" v-if="text">
                            <textarea class="BG_color_lavender" v-model="text" placeholder="コメント（サブ道具などあれば）"></textarea>
                        </div>
                        <div class="text" v-else>
                            <textarea v-model="text" placeholder="この技のコツは..."></textarea>
                        </div>
                    </div>
                    
                    <div class="edit_button_phone">
                        <button  v-on:click="closeModal">キャンセル</button>
                        <button class="BG_color_purple color_white" v-on:click="update()">保存</button>
                    </div>
                    
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                showContent: false,
                fileData: '',
                url: '',
                radioValue: '',
                tools: [],
                selectTool: '',
                selectNumber: '',
                technique: '',
                text: ''
            }
        },
        mounted () {
            this.getTools(); // 道具データ
        },
        methods:{
            getTools() { // 道具データの取得
                axios.get('/gettool')
                .then(res => {
                    this.tools = res.data.tools; // resのdataのauth_user
                    console.log(this.tools,"Toolsの中身")
                }).catch(function(error) {
                    console.log(this.tools)
                });
            },
            openModal(){
                this.showContent = true
            },
            closeModal(){
                this.showContent = false
            },
            stopEvent(){
                event.stopPropagation()
            },
            handleFile(event){
          		this.fileData = event.target.files[0]
                console.log(this.fileData,"Videoの中身")
                const getPreview = this.$refs.preview.files[0];
                this.url = URL.createObjectURL(getPreview)
                console.log(this.url,"videoのプレビューURL")
          	},
          	selectSequence(){
          	    this.technique = "シークエンス"
          	},
          	selectTechnique(){
          	    this.technique = ""
          	},
          	post() {
          	    //formDataをnewする
                let formData = new FormData();
                //appendでデータを追加(第一引数は任意のキー)
                //他に送信したいデータがある場合にはその分appendする
                
                formData.append('file', this.fileData);
                formData.append('tool_name', this.selectTool);
                formData.append('tool_number', this.selectNumber);
                formData.append('technique', this.technique);
                formData.append('text', this.text);
                console.log(this.fileData)
          	    // ヘッダー定義
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
          	    
                axios.post('/posts/create', formData, config)
                .then(response => {
                    console.log("成功");
                    window.location.href = '/'; // 削除後にリダイレクト 
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
<style>
#overlay_post{
  /*　要素を重ねた時の順番　*/
  z-index:2;
  
  /*　画面全体を覆う設定　*/
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;
}

#content_post{
  z-index:3;
  padding: 1em;
  position:relative;
}

.close_btn{
    font-size:40px;
    margin:0 10px;
    position:absolute;
    top:0;
    left:0;
}
.edit_btn{
    border-radius:10px;
    position:absolute;
    top:15px;
    right:15px;
}

.post_header{
    margin:0 auto;
    text-align:center;
}

.preview_container{
    width:100%;
    height:auto;
    margin:0 auto;
    text-align:center;
}

.preview_container p{
    margin:0;
}

.preview_video{
    display:inline-block;
    height:300px;
    width:100%;
}

.preview_video video{
    height:100%;
    width:auto;
}


.preview_post_title{
    height:auto;
    width:100%;
}
.preview_post_title p{
    display:inline-block;
}
.preview_post_text{
    height:auto;
    width:100%;
}

.post_video label{
    padding: 5px 20px;
    margin:0;
    cursor: pointer;
    display:inline-block;
}

input[type="file"] {
    display: none;
}

.post_box{
    float:left;
    display:flex;
    width:100%;
    
}

.post_box p{
    margin:0;
    display:inline-block;
}

.post_label{
    width:5em;
}

.text{
    width:100%;
}

.text textarea{
    width:90%;
    margin-left:5px;
    display:inline-block;
}
/*1170px以上(パソコン用)*/
@media(min-width:1170px){
    .modal_content{
        width:55%;
    }
    .edit_button{
        display:inline;
    }
    .edit_button_phone{
        display:none;
    }
}
/*1170px以下(パソコン用)*/
@media(max-width:1170px){
    .modal_content{
        width:60%;
    }
    .edit_button{
        display:inline;
    }
    .edit_button_phone{
        display:none;
    }
}
/*960px以下(タブレット用)*/
@media(max-width:960px){
    .modal_content{
        width:70%;
    }
    .edit_button{
        display:inline;
    }
    .edit_button_phone{
        display:none;
    }
}
/*520px以下(スマホ用)*/
@media(max-width:520px){
    .modal_content{
        width:100%;
        height:100%;
    }
    .edit_button{
        display:none;
    }
    .edit_button_phone{
        display:inline;
    }
}
</style>