<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    <button @click="unlike()" class='btn btn-danger' v-if="result">
                        いいね解除
                    </button>
                    <button @click="like()" class='btn btn-success' v-else>
                        いいね
                    </button>
                    <p>いいね数：{{count}}</p>
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
                count: "",
                result: ""
            }
        },
        mounted () {
            this.haslikes();
            this.countlikes();
        },
        methods: {
            like() {
                axios.get('/posts/' + this.post.id +'/likes')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unlike() {
                axios.delete('/posts/' + this.post.id +'/unlikes')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error){
                    console.log(error);
                });
            },
            countlikes() {
                axios.get('/posts/' + this.post.id +'/countlikes')
                .then(res => {
                    this.count = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            haslikes() {
                axios.get('/posts/' + this.post.id +'/haslikes')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
