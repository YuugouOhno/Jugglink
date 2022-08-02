<template>
    <div>
        <a v-on:click="openModal" class='color_black'>
            プロフィールの編集
        </a>
        <div id="overlay_profile" v-show="showContent" v-on:click="closeModal">
            <div id="content_profile" class="modal_content BG_color_white" v-on:click="stopEvent">
                <div class="edit_button">
                    <button class="btn" v-on:click="closeModal">
                        <i class="fa-solid fa-xmark close_btn color_black"></i>
                    </button>
                    <button class="edit_btn BG_color_purple color_white" v-on:click="update()">保存</button>
                </div>
                <div class="edit_header">
                    <h5>プロフィールの編集</h5>
                </div>
                <div v-if="fileData">
                    <div v-if="url">
                        <img class="edit_user_icon border_color_purple" :src="url">
                    </div>
                </div>
                <div v-else>
                    <div v-if="user.icon_path === null">
                        <i class="fa-solid fa-circle-user edit_user_icon border_color_purple"></i>
                    </div>
                    <div v-else>
                        <img class="edit_user_icon border_color_purple" :src=user.icon_path>
                    </div>
                </div>
                <div class="edit_boxes">
                    <div class="edit_icon edit_box">
                        <p>プレビュー</p>
                        <div class="color_black BG_color_lavender border_color_purple" v-if="fileData">
                            <label>
                                <input type='file' ref="preview" @change="handleFile" name="file">選択済み
                            </label>
                        </div>
                        <div class="color_black BG_color__white border_color_purple" v-else>
                            <label>
                                <input type='file' ref="preview" @change="handleFile" name="file">アイコンを選択
                            </label>
                        </div>
                    </div>
                    <div class="edit_tool edit_box">
                        <p>メイン道具</p>
                        <select class="border_color_purple BG_color_lavender" v-model="selectTool">
                    	    <option disabled value="">道具を選択</option>
                    		<option v-for="tool in tools" :key="tool.id" :value="tool.id">
                                {{ tool.tool_name }}
                            </option>
                    	</select>
                    </div>
                    <div class="edit_name edit_box">
                        <p>アカウント名</p>
                        <div v-if="name">
                            <input type='text' class="border_color_purple BG_color_lavender" v-model="name" placeholder="アカウント名">
                        </div>
                        <div v-else>
                            <input type='text' class="border_color_red" v-model="name" placeholder="アカウント名">
                            <p class="color_red">アカウント名は必須項目です。</p>
                        </div>
                    </div>
            	</div>
            	<div>
                    <div class="introduce edit_box" v-if="introduce">
                        <p>コメント</p>
                        <textarea class="BG_color_lavender" v-model="introduce" placeholder="コメント（サブ道具などあれば）"></textarea>
                    </div>
                    <div class="introduce edit_box" v-else>
                        <p>コメント</p>
                        <textarea v-model="introduce" placeholder="コメント（サブ道具などあれば）"></textarea>
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
        props: {
            user: [],
        },
        data() {
            return {
                showContent: false,
                fileData: '',
                url: '',
                tools: [],
                selectTool: '',
                introduce: '',
                name: ''
            }
        },
        mounted () {
            this.fetchAuth(); // 認証データ
            this.getTools(); // 道具データ
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
                console.log(this.fileData,"iconの中身")
                const getPreview = this.$refs.preview.files[0];
                this.url = URL.createObjectURL(getPreview)
                console.log(this.url,"iconのプレビューURL")
          	},
          	update() {
          	    //formDataをnewする
                let formData = new FormData();
                //appendでデータを追加(第一引数は任意のキー)
                formData.append('file', this.fileData);
                formData.append('name', this.name);
                formData.append('tool_id', this.selectTool);
                formData.append('introduce', this.introduce);
                console.log(formData,"formDataの中身")
                console.log(this.fileData)
          	    // ヘッダー定義
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                
                axios.post('/users/profile/update', formData, config)
                .then(response => {
                    console.log("成功");
                    window.location.href = '/users/' + this.auth_user.id + '/profile/posts'; // 保存後にリダイレクト 
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
<style>
#overlay_profile{
  /*　要素を重ねた時の順番　*/
  z-index:10;

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

#content_profile{
  z-index:11;
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
.edit_button_phone{
    width:100%;
    text-align:center;
    margin:10px auto;
    float:right;
}
.edit_header{
    margin:0 auto;
    text-align:center;
}
.edit_user_icon{
    font-size:100px;
    display:inline-block;
    width:100px;
    height:100px;
    border-radius:50%;
}
.edit_boxes{
    width:100%;
    height:35px;
    margin:10px 0;
}
.edit_box{
    float:left;
    padding:2px;
}

.introduce{
    width:100%;    
}

.edit_box p{
    margin:0px;
}

.introduce textarea{
    width:100%;    
}

.edit_icon input, .edit_name input, .edit_tool select{
    width:100%;
    height:100%;
}

.edit_icon label {
    width:100%;
    padding: 5px 20px;
    margin:0;
    cursor: pointer;
}

input[type="file"] {
    display: none;
}
/*1170px以上(パソコン用)*/
@media(min-width:1170px){
    .modal_content{
        width:55%;
    }
    .edit_icon, .edit_tool{
        width:30%;
    }
    .edit_name{
        width:40%;
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
    .edit_icon, .edit_tool{
        width:30%;
    }
    .edit_name{
        width:40%;
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
    .edit_name{
        width:100%;
    }
    .edit_tool, .edit_icon{
        width:50%;
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
    .edit_icon, .edit_tool, .edit_name{
        width:100%;
    }
    .edit_button{
        display:none;
    }
    .edit_button_phone{
        display:inline;
    }
}
</style>