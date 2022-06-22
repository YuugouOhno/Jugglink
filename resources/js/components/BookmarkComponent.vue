<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    <button @click="unbookmark()" class='btn btn-danger' v-if="result">
                        ブックマーク解除
                    </button>
                    <button @click="bookmark()" class='btn btn-success' v-else>
                        ブックマーク
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['post'],
        data() {
            return {
                result: ""
            }
        },
        mounted () {
            this.hasbookmarks();
        },
        methods: {
            bookmark() {
                axios.get('/posts/' + this.post.id +'/bookmarks')
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unbookmark() {
                axios.delete('/posts/' + this.post.id +'/unbookmarks')
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error){
                    console.log(error);
                });
            },
            hasbookmarks() {
                axios.get('/posts/' + this.post.id +'/hasbookmarks')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
