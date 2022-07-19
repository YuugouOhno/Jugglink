<template>
    <div>
        <button @click="unlike()" class='btn' v-if="result">
            <i class="fa-solid fa-heart" style="color:red;"></i>{{count}}
        </button>
        <button @click="like()" class='btn' v-else>
            <span><i class="fa-regular fa-heart color_black"></i>{{count}}</span>
        </button>
    </div>
</template>
<script>
    export default {
        props: {
            post_id: Number
        },
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
                axios.get('/posts/' + this.post_id +'/likes')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unlike() {
                axios.delete('/posts/' + this.post_id +'/unlikes')
                .then(res => {
                    this.result = res.data.result;
                    this.count = res.data.count;
                }).catch(function(error){
                    console.log(error);
                });
            },
            countlikes() {
                axios.get('/posts/' + this.post_id +'/countlikes')
                .then(res => {
                    this.count = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            },
            haslikes() {
                axios.get('/posts/' + this.post_id +'/haslikes')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
