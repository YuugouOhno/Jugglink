<template>
    <div>
        <a v-on:click="openModal"　class='color_black'>
            投稿する
        </a>
        <div id="overlay" v-show="showContent" v-on:click="closeModal">
            <div id="content" v-on:click="stopEvent">
                    <h1>新規投稿を作成</h1>
                    <div class="video">
                        <h2>動画</h2>
                        <input type='file' accept="video/mp4,video/x-m4v" @change="handleFile">
                    </div>
                    <p>{{fileData.name}}</p>
                    <input type="radio" v-model="radioValue" value="technique"> 技
                	<input type="radio" v-model="radioValue" value="sequence"> シークエンス
                	<p>{{ radioValue }}</p>
                	
                	<select v-model="selectTool">
                	    <option disabled value="">道具を選択</option>
                		<option v-for="tool in tools" :key="tool.id" :value="tool.id">
                            {{ tool.tool_name }}
                        </option>
                	</select>
                	<p>{{selectTool}}</p>
                	
                	<select v-model="selectNumber">
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
                	<p>{{selectNumber}}</p>
                	
                    <div class="technique">
                        <h2 id='not_sequence'>技名</h2>
                        <input type="text" v-model="technique" placeholder="技名"/>
                    </div>
                    <p>{{technique}}</p>
                    
                    <div class="text">
                        <h2>コメント</h2>
                        <textarea v-model="text" placeholder="この技のコツは..."></textarea>
                    </div>
                    <p>{{text}}</p>
                    <button v-on:click="post()">投稿する</button>
                <button v-on:click="closeModal">close</button>
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
                radioValue: '',
                tools: [],
                selectTool: '',
                selectNumber: '',
                technique: '',
                text: ''
            }
        },
        mounted () {
            this.getTools(); // 認証データ
        },
        methods:{
            getTools() { // 認証データの取得
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
                console.log(this.fileData,"Videoの中身")
          	},
          	post($state) {
                axios.post('/posts/create', { // コントローラーへ
                    params: {
                        fileData: JSON.stringify(this.fileData), // 動画
                        tool_id: this.selectTool,
                        tool_number: this.selectNumber,
                        technique: this.technique,
                        text: this.text,
                    }
                })
                .then(response => {
                    console.log("成功");
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
<style>
#overlay{
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

#content{
  z-index:2;
  width:50%;
  padding: 1em;
  background:#fff;
}
</style>