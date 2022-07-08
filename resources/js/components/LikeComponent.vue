<template>
    <div class='like_container'>
        <button @click="unlike()" class='btn like_btn' v-if="result">
            <i class="fa-solid fa-heart" style="color:red;"></i>
        </button>
        <button @click="like()" class='btn like_btn' v-else>
            <i class="fa-regular fa-heart" style="color:red;"></i>
        </button>
        <p class='like_counts'>{{count}}</p>
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
