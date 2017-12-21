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
        <div id="top">
            <span style="float:right;">
                <el-button type="text" @click="add" style="color:blue">添加</el-button>
                <el-button type="text" @click="deletenames" style="color:red">批量删除</el-button>
            </span>
        </div>
        <el-input placeholder="请输入内容" v-model="criteria" style="padding-bottom:10px;">
            <el-select v-model="select" slot="prepend" placeholder="请选择">
                <el-option label="id" value="1"></el-option>
                <el-option label="name" value="2"></el-option>
            </el-select>
            <el-button slot="append" icon="search" v-on:click="search"></el-button>
        </el-input>
        <el-table
                :data="tableData"
                border
                style="width: 100%"
                v-loading="loading"
                element-loading-text="加载中..."
                element-loading-spinner="el-icon-loading"
                element-loading-background="rgba(0, 0, 0, 0.8)">
            <el-table-column type="selection" width="55">
            </el-table-column>
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
                <template slot-scope="scope">
                    <div v-html="scope.row.content"></div>
                </template>
            </el-table-column>
            <el-table-column
                    label="操作">
                <template slot-scope="scope">
                    <el-button
                            size="small"
                            type="primary"
                            @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="small"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div class="block">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="page.currentPage"
                    :page-sizes="[10, 20, 50, 100]"
                    :page-size="page.perPage"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="page.total">
            </el-pagination>

        </div>
        <paginate
                v-bind:row-click="rowClick"
                :sort-change="sortChange"
                :table-data="tableData"
                :columns="columns"
                :total-count="page.total"
                :page-size="page.perPage"
                :is-loading="loading"
                :checkBox="true"
                @currentPageChange="handleCurrentChange"></paginate>
    </div>
</template>
<style>
    .header-info-list{
        margin:5px auto;
    }
</style>
<script>
    import Paginate from '../components/pagination/paginate.vue'
    import qs from 'qs'
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
            columns:[{
                fixed:false,
                value:'name',
                label:'姓名',
                key:'123',
                width:'auto',
                sortable:true
            },{
                fixed:false,
                value:'title',
                label:'标题',
                key:'456',
                width:'auto',
                sortable:true
            },{
                fixed:false,
                value:'abc',
                label:'正文',
                key:'789',
                width:'auto',
                sortable:true
            }],
            loading:true,
            //搜索条件
            criteria:'',
            //下拉菜单
            select:''
        }


    },
    computed: {
        test:function(){
            console.log('component computed');
        }
    },
    components:{
        Paginate
    },
    created(){
        console.log('component created');
//        this.getArticle();
        this.loadData('',1,10);
    },
    methods: {
        init:function(val,data){
            alert('init'+val+data);
            console.log('method init');
        },
        rowClick:function(){

        },
        sortChange:function(){

        },
        loadData:function(criteria,pageNum,pageSize){
            let params = {
                page:pageNum,
                perPage:pageSize,
                query:criteria
            }
            this.loading = true;
            axios.get('/api/get_list',{params:params}).then((response)=>{
                var data = response.data;
                this.tableData = data.items;
                this.page.total = data.total;
             }).catch(function(error){
                console.log(error);
            });
            this.loading = false;
        },
        handleSizeChange(val) {
            console.log(`每页 ${val} 条`);
            this.page.perPage = val;
            this.loadData(this.criteria,this.page.currentPage,this.page.perPage);
        },
        handleCurrentChange(val) {
            console.log(`当前页: ${val} ${this.page.perPage}`);
            this.page.currentPage = val;
            this.loadData(this.criteria,this.page.currentPage,this.page.perPage);
        },
        add:function(){
            alert('add');
        },
        deletenames:function(){
            alert('delete');
        },
        search:function(){
            this.loadData(this.criteria, this.currentPage, this.pagesize);
        },
        handleEdit:function(){
            this.$prompt('请输入新名称','提示',{
                confirmButtonTest:'确定',
                cancelButtonText:'取消',
            }).then(( value ) =>{
                if( value == '' || value == null){
                    return ''
                }
                alert('edit');
                axios.post('/api/get_list/edit',{'id':row.id,'name':row.name}).then(function(res){
                    if(res.data.status == 1){

                    }else{

                    }
                }).catch(()=>{
                    console.log('failed');
                })

            });
        },
        handleDelete:function(index,row){
            var array = [];
            array.push(row.id);

            axios.post('/api/get_list/del',{array:array}).then((response) =>{
                var res = response.data;
                if(res.status == 1){
                    alert(res.msg);
                }else{
                    alert(res.msg);
                }
                this.loadData(this.criteria,this.page.currentPage,this.page.perPage);
            }).catch(function(error){
                console.log(error);
            });

        }

    }
});
</script>