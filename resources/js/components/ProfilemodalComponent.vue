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
                        <div v-bind:class="fileData ? 'color_black BG_color_lavender border_color_purple' : 'color_black BG_color__white border_color_purple' ">
                            <label>
                                <input type='file' ref="preview" @change="handleFile" name="file">
                                <p v-if="fileData">選択済み</p>
                                <p v-else>アイコンを選択</p>
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
                        <div>
                            <input type='text' v-bind:class="name ? 'border_color_purple BG_color_lavender' : 'border_color_red'" v-model="name" placeholder="アカウント名">
                            <p class="color_red" v-if="!name">アカウント名は必須項目です。</p>
                        </div>
                    </div>
            	</div>
            	<div>
                    <div class="introduce edit_box">
                        <p>コメント</p>
                        <textarea v-bind:class="introduce ? 'BG_color_lavender' : ''" v-model="introduce" placeholder="コメント（サブ道具などあれば）"></textarea>
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
                    this.selectTool = this.auth_user.tool.id;
                    this.introduce = this.auth_user.introduce;
                    this.name = this.auth_user.name;
                }).catch(function(error) {
                    console.log(error)
                });
            },
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
          	update() {
          	    //formDataをnewする
                let formData = new FormData();
                //appendでデータを追加(第一引数は任意のキー)
                formData.append('file', this.fileData);
                formData.append('name', this.name);
                formData.append('tool_id', this.selectTool);
                formData.append('introduce', this.introduce);
          	    // ヘッダー定義
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
                
                axios.post('/users/profile/update', formData, config)
                .then(response => {
                    window.location.href = '/users/' + this.auth_user.id + '/profile/posts'; // 保存後にリダイレクト 
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>