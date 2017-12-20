<template>
    <div class="container header-info-list">
        <h3>首页推荐</h3>
        <!--<ul class="list-group">-->
            <!--<li class="list-group-item"-->
                <!--v-for="row in recommend">-->
                <!--<router-link :to="{path:'/newsdetail/' + row.id}">-->
                    <!--{{ row.title }}-->
                <!--</router-link>-->
                <!--<li class="list-group-item">-->
                    <!--<router-link to="/newslist">更多</router-link>-->
                <!--</li>-->
            <!--</li>-->
        <!--</ul>-->
        <el-table
                :data="tableData"
                border
                style="width: 100%"
                v-loading="loading"
                element-loading-text="加载中..."
                element-loading-spinner="el-icon-loading"
                element-loading-background="rgba(0, 0, 0, 0.8)">
            <el-table-column
                    prop="name"
                    label="名称"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="标题"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="content"
                    label="正文">
            </el-table-column>
        </el-table>
        <div class="block">
            <span class="demonstration">大于 7 页时的效果</span>
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="page.currentPage"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="10"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="page.total">
            </el-pagination>
        </div>
    </div>
</template>
<style>
    .header-info-list{
        margin:5px auto;
    }
</style>
<script>
export default({
    // 映射 vuex 上面的属性
    data(){
        return {
            tableData: [],
            page:{
                total:0,
                perPage:10,
                currentPage:1,
                lastPage:0,
                from:0,
                to:0
            },
            loading:true
        }

    },
    computed: {
        test:function(){
            console.log('component computed');
        }
    },
    created(){
        console.log('component created');
        this.getArticle();
    },
    methods: {
        init:function(){
            console.log('method init');
        },
        getArticle:function(){
                this.loading = true;
                axios.get('/api/get_list').then((response) =>{

                    var return_data = response.data;
                    this.tableData = return_data.items;
                    this.page.total = return_data.total;
                    this.page.perPage = return_data.perPage;
                    this.page.currentPage = return_data.currentPage;
                    this.page.lastPage = return_data.lastPage;
                    this.page.from = return_data.from;
                    this.page.to = return_data.to;
                    this.loading = false;
                    console.log(return_data);
                 }).catch(function(error){
                    console.log(error);
                });
        },
        handleSizeChange(val) {
            console.log(`每页 ${val} 条`);
            this.loading = true;
            axios('api/get_list?page='+this.page.currentPage+'&perPage='+val).then((response)=>{
                var data = response.data;
            this.tableData = data.items;
            this.page.total = data.total;
            this.page.perPage = val;
            this.page.currentPage = data.currentPage;
            this.page.lastPage = data.lastPage;
            this.page.from = data.from;
            this.page.to = data.to;
            this.loading = false;
        }).catch(function(error){
                console.log(error);
            });
        },
        handleCurrentChange(val) {
            console.log(`当前页: ${val} ${this.page.perPage}`);
            this.loading = true;
            axios('api/get_list?page='+val+'pageSize='+this.page.perPage).then((response)=>{
                var data = response.data;
                this.tableData = data.items;
                this.page.total = data.total;
                this.page.perPage = data.perPage;
                this.page.currentPage = data.currentPage;
                this.page.lastPage = data.lastPage;
                this.page.from = data.from;
                this.page.to = data.to;
            this.loading = false;
            }).catch(function(error){
                console.log(error);
            });
        }

    }
});
</script>