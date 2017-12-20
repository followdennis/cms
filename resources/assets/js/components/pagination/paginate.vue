<template>
    <div class="el-table-self">
        <el-table
                @row-click="rowClick"
                :data="tableData"
                :height="tableHeight"
                @sort-change="sortChange"
                border
                @selection-change="selectionChange"
                style="width: 100%">
            <el-table-column v-if="checkBox" type="selection" width="55">
            </el-table-column>
            <el-table-column
                    v-for="column in columns"
                    :fixed="column.fixed"
                    :prop="column.value"
                    :label="column.label"
                    :key="column.value"
                    :width="column.width"
                    :sortable="column.sortable">
            </el-table-column>
        </el-table>
        <div class="pagination-footer">
            <span class="description">{{description}}</span>
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="pageSizes"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="totalCount">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                currentPage:1,
                tpageSize:20
            }
        },
        props:{
            rowClick:Function,
            tableData:Array,    //表格数据s
            columns:Array,      //表格列配置数据,{vlaue:对应数据对象中的属性，label：对应的是标题文字，className：对应的是列的样式类名}
            totalCount:Number,  //表格数据总数
            pageSizes:Array,    //决定每页显示的条数[10,15,20,25]
            checkBox:Boolean,  //决定是否显示复选框
            description:String, //分页脚底左侧的数据说明
            tableHeight:Number,  //分页列表的高度
            pageSize:Number,
            isLoading:Boolean,
            sortChange:Function//用户点击列表头进行排序 { column, prop, order }
        },
        watch:{
            pageSize:"changeSize"
        },
        methods:{
            changeSize:function(){
                this._data.tpageSize = this.pageSize;
            },
            handleSizeChange:function(size){
                this.$emit("pageSizeChange",size);

            },
            handleCurrentChange:function(currentPage){
                this.$emit("currentPageChange",currentPage);
            },
            selectionChange:function(selections){
                this.$emit("selectionChange",selections);
            }
        }
    }

</script>