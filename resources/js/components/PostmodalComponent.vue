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
                        <input type="radio" v-model="radioValue" value="technique" @change="selectTechnique"> 技
                	    <input type="radio" v-model="radioValue" value="sequence" @change="selectSequence"> シークエンス
                        <div v-if="!radioValue">
                    	    <p class="color_red">どちらかを選択してください。</p>
                        </div>
                    </div>
                    
                    <div class="post_video post_box">
                        <p class="post_label">動画</p>
                        <div v-bind:class="fileData ? 'color_black BG_color_lavender border_color_purple' : 'color_black BG_color__white border_color_red'">
                            <label>
                                <input type='file' ref="preview" @change="handleFile" name="file">
                                <p v-if="fileData">選択済み</p>
                                <p v-else>ファイルを選択してください</p>
                            </label>
                        </div>
                        <p class="color_red" v-if="!fileData">動画は必須項目です。</p>
                    </div>
                    
                    <div class="post_tool post_box">
                	    <p class="post_label">道具</p>
                	    <div v-if="">
                	        <select v-bind:class="selectTool ? 'border_color_purple BG_color_lavender' : 'border_color_red' " v-model="selectTool">
                        	    <option disabled value="">道具を選択</option>
                        		<option v-for="tool in tools" :key="tool.id" :value="tool.tool_name">
                                    {{ tool.tool_name }}
                                </option>
                        	</select>
                        	<p class="color_red" v-if="!selectTool">道具は必須項目です。</p>
                	    </div>
                    </div>
                    
                	<div class="post_toolnumber post_box">
                	    <p class="post_label">道具数</p>
                	    <div>
                	        <select v-bind:class="selectNumber ? 'border_color_purple BG_color_lavender' : 'border_color_red'" v-model="selectNumber">
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
                            <p class="color_red" v-if="!selectNumber">道具数は必須項目です。</p>
                	    </div>
                    </div>
                    
                    <div class="post_technique post_box" v-if="radioValue==='technique'">
                        <p class="post_label">技名</p>
                        <div>
                            <input type='text' v-bind:class="technique ? 'border_color_purple BG_color_lavender' : 'border_color_red'" v-model="technique" placeholder="技名を入力">
                            <p style="color:red" v-if="!technique">技名は必須項目です。</p>
                        </div>
                    </div>
                    
                    <div　class="post_box">
                        <p class="post_label">コメント</p>
                        <div class="text">
                            <textarea v-bind:class="text ? 'BG_color_lavender' : ''" v-model="text" placeholder="この技のコツは..."></textarea>
                        </div>
                    </div>
                    
                    <div class="edit_button_phone">
                        <button  v-on:click="closeModal">キャンセル</button>
                        <button class="BG_color_purple color_white" v-on:click="update()">投稿</button>
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
                }).catch(function(error) {
                    console.log(error)
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
                const getPreview = this.$refs.preview.files[0];
                this.url = URL.createObjectURL(getPreview)
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
          	    // ヘッダー定義
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
          	    
                axios.post('/posts/create', formData, config)
                .then(response => {
                    window.location.href = '/'; // 削除後にリダイレクト 
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>