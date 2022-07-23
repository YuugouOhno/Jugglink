<template>
    <div>
        <a v-on:click="openModal"　class='color_black'>
            プロフィール編集のモーダル
        </a>
        <div id="overlay2" v-show="showContent" v-on:click="closeModal">
            <div id="content2" v-on:click="stopEvent">
                    <p>プロフィールを編集</p>
                    <div>
                        <div v-if="user.icon_path === null">
                            <i class="fa-solid fa-circle-user user_icon"></i>
                        </div>
                        <div v-else>
                            <img class="user_icon" :src=user.icon_path>
                        </div>
                    </div>
                    <div class="profile_icon">
                        <p>アイコン</p>
                        <input type='file' @change="handleFile" name="file">
                    </div>
                    
                    <input type='text' v-model="name" placeholder="アカウント名">
                	
                	<select v-model="selectTool">
                	    <option disabled value="">道具を選択</option>
                		<option v-for="tool in tools" :key="tool.id" :value="tool.id">
                            {{ tool.tool_name }}
                        </option>
                	</select>
                	<p>コメント</p>
                    <div class="introduce">
                        <textarea v-model="introduce" placeholder="コメント（サブ道具などあれば）"></textarea>
                    </div>
                    <button v-on:click="update()">編集する</button>
                <button v-on:click="closeModal">close</button>
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
          		// this.fileData = JSON.stringify(this.fileData.name);
                console.log(this.fileData,"iconの中身")
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
                    // window.location.href = '/users/' + this.auth_user.id + '/profile/posts'; // 削除後にリダイレクト 
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
<style>
#overlay2{
  /*　要素を重ねた時の順番　*/
  z-index:1;

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

#content2{
  z-index:2;
  width:50%;
  padding: 1em;
  background:#fff;
}
</style>