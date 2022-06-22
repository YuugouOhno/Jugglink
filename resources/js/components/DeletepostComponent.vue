<template>
    <div class="container">
        <div class="row justify-content-center mt-1">
            <div class="col-md-12">
                <div>
                    <button @click="deletepost()" class='btn btn-danger'>
                        削除
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
        methods: {
            deletepost() {
                if(confirm("削除しますか？")){
                    axios.delete('/posts/' + this.post.id +'/delete')
                    .then(res => {
                    this.result = res.data.result;
                    }).catch(function(error){
                        console.log(error);
                    });
                }
            }
        }
    }
</script>