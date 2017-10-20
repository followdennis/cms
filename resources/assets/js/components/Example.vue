<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                       这是一个vue组件!
<<<<<<< HEAD
                       你好，我是vdddad
                       <el-button>默认按钮</el-button>
                       <el-button type="primary">主要按钮</el-button>
                       <el-button type="text">按钮</el-button>
=======
                        {{ message }}
>>>>>>> b15e8056307b6cccf0e4044794b4d667a054de03
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data:function(){
            return {
                message:"abc"
            }
        }

    }

</script>
