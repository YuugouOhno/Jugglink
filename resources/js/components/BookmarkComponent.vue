<template>
    <div>
        <button @click="unbookmark()" class='btn' v-if="result">
            <i class="fa-solid fa-bookmark" style="color:blue;"></i>
        </button>
        <button @click="bookmark()" class='btn' v-else>
            <i class="fa-regular fa-bookmark color_black"></i>
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
                result: ""
            }
        },
        mounted () {
            this.hasbookmarks();
        },
        methods: {
            bookmark() {
                axios.get('/posts/' + this.post_id +'/bookmarks')
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error) {
                    console.log(error);
                });
            },
            unbookmark() {
                axios.delete('/posts/' + this.post_id +'/unbookmarks')
                .then(res => {
                    this.result = res.data.result;
                }).catch(function(error){
                    console.log(error);
                });
            },
            hasbookmarks() {
                axios.get('/posts/' + this.post_id +'/hasbookmarks')
                .then(res => {
                    this.result = res.data;
                }).catch(function(error){
                    console.log(error);
                });
            }
        }
    }
</script>
