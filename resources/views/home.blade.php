@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                <a href="#" class="list-group-item active">商品管理</a>
                <a href="#" class="list-group-item"><i class="fa fa-edit"></i> 一级分类</a>
                <a href="#" class="list-group-item"><i class="fa fa-home"></i>二级分类</a>
                <a href="#" class="list-group-item"><i class="fa fa-address-book-o"></i>商品列表</a>
                <a href="#" class="list-group-item"><i class="fa fa-trash"></i>废纸篓</a>
                <a href="#" class="list-group-item"><i class="glyphicon glyphicon-fast-backward"></i>快退</a>
            </div>
            <div class="col-sm-10">
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                        <tr>
                            <th>编号</th>
                            <th>图标</th>
                            <th>名称</th>
                            <th>价格</th>
                            <th>邮费</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>15</td>
                            <td>
                                <img src="img/test.jpg" class="img-thumbnail" style="height: 30px;" />
                            </td>
                            <td>超人气无花果</td>
                            <td>18.00￥</td>
                            <td>18.00￥</td>
                            <td>上架</td>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-default">修改</a><a href="" class="btn btn-default">下架</a><a href="" class="btn btn-danger">删除</a>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>
                                <img src="img/test.jpg" class="img-thumbnail" style="height: 30px;" />
                            </td>
                            <td>超人气无花果</td>
                            <td>18.00￥</td>
                            <td>18.00￥</td>
                            <td>上架</td>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-default">修改</a><a href="" class="btn btn-default">下架</a><a href="" class="btn btn-danger">删除</a>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>
                                <img src="img/test.jpg" class="img-thumbnail" style="height: 30px;" />
                            </td>
                            <td>超人气无花果</td>
                            <td>18.00￥</td>
                            <td>18.00￥</td>
                            <td>上架</td>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-default">修改</a><a href="" class="btn btn-default">下架</a><a href="" class="btn btn-danger">删除</a>
                                </div>

                            </td>
                        </tr>
                        <tr>
                            <td>15</td>
                            <td>
                                <img src="img/test.jpg" class="img-thumbnail" style="height: 30px;" />
                            </td>
                            <td>超人气无花果</td>
                            <td>18.00￥</td>
                            <td>18.00￥</td>
                            <td>上架</td>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-default">修改</a><a href="" class="btn btn-default">下架</a><a href="" class="btn btn-danger">删除</a>
                                </div>

                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="row">
        <div class="col-md-2">
            <div class="panel-group table-responsive" role="tablist">
                <div class="panel panel-primary leftMenu">
                    <!-- 利用data-target指定要折叠的分组列表 -->
                    <div class="panel-heading" id="collapseListGroupHeading1" data-toggle="collapse" data-target="#collapseListGroup1" role="tab" >
                        <h4 class="panel-title">
                            分组1
                            <span class="glyphicon glyphicon-chevron-up right"></span>
                        </h4>
                    </div>
                    <!-- .panel-collapse和.collapse标明折叠元素 .in表示要显示出来 -->
                    <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <!-- 利用data-target指定URL -->
                                <button class="menu-item-left" data-target="test2.html">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-1
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-2
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="glyphicon glyphicon-chevron-right"></span>分组项1-3
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-4
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-5
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-6
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-7
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-8
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-9
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-10
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项1-11
                                </button>
                            </li>
                        </ul>
                    </div>
                </div><!--panel end-->
                <div class="panel panel-primary leftMenu">
                    <div class="panel-heading" id="collapseListGroupHeading2" data-toggle="collapse" data-target="#collapseListGroup2" role="tab" >
                        <h4 class="panel-title">
                            分组2
                            <span class="glyphicon glyphicon-chevron-down right"></span>
                        </h4>
                    </div>
                    <div id="collapseListGroup2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项2-1
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项2-2
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项2-3
                                </button>
                            </li>
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项2-4
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            内容
        </div>
    </div>
    <nav class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            固定底部
        </div>
    </nav>



@endsection
