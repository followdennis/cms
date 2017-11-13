<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                       这是一个vue组件!

                       数据调用
                       <el-button>默认按钮</el-button>
                       <el-button type="primary">主要按钮</el-button>
                       <el-button type="text">按钮</el-button>

                        {{ message }}

                    </div>
                </div>
                <div>
                    <table id="table_data" border=1 width=400 cellspacing=0 cdllpadding=0>
                    <tr><td>id</td><td>标题</td></tr>
                    <tr  v-for="value in data">
                        <td>{{ value.id }}</td>
                        <td>{{ value.title }}</td>
                    </tr>
                    </table>
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
                message:"abc",
                data:""
            }
        },
        created: function() {
              this.$http.get('/vue_data',
                  {
                      productType:"1",
                      pageNum:1,
                      pageLimit:8
                  },
                  {
                    headers:{

                    },
                    emulateJSON: true
                  }

              ).then((response) => {
                var json = response.bodyText;
                var usedData= JSON.parse(json);
                this.data = usedData;
              }).catch(function(response) {
                console.log(response)
              });
        }

    }

</script>
