<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ message }}</div>

                    <div class="panel-body">
                      <button v-on:click="reverseMessage">点击事件</button>
                    </div>
                    <div class="panel-body">
                    <p>{{ msg }}</p>
                     <input v-model="msg">
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            console.log('abc')
        },
        data:function(){
             return {
                 message:"你好",
                 msg:"hello input"
             }
         },
         methods:{
            reverseMessage:function(){
                this.message=this.message.split('').reverse().join('')
            }
         }

    }
</script>