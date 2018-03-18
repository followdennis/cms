<html>
<head>
<title>表格数据插入</title>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/layer-v3.1.1/layer/layer.js') }}" ></script>
<script  type='text/javascript' src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <link rel='stylesheet' type='text/css' href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}">
</head>
<body>
<div class="container">
    <table class="table" id="table_data">
        <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>name</th>
            <th>发货日期</th>
        </tr>

        </thead>
        <tbody>
        @foreach($data as $item)
            <tr data-id="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->click }}天（工作日）</td>
                <td><a href="javascript:void(0);" onclick="editArticle($(this).parent().parent())">编辑</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <button class="btn btn-default" onclick="getJsonData()" type="button">确定</button>
    </div>
</div>
</body>
<script>
 $(function(){

 })
 function editArticle(obj){

     var title;
     var name;
     var date;
     title = $(obj).find('td').eq(1).text();
     name = $(obj).find('td').eq(2).text();
     date = $(obj).find('td').eq(3).text().replace('（工作日）','');
     console.log(date);
     layer.open({
         type: 2,
         area:['400px','380px'],
         content:"table/edit?title="+title+"&name="+name+"&date="+date,

     });
 }
 function getJsonData(){
    var count = $("#table_data tr").length;
    var data = new Array();
    for(var i=1;i<count;i++){
        var title = $("#table_data tr").eq(i).find('td').eq(1).text();
        var name = $("#table_data tr").eq(i).find('td').eq(2).text();
        var date = $("#table_data tr").eq(i).find('td').eq(3).text();

        data.push({title:title,name:name,date:date});
    }
    var all = new Array();
     all.push({company:'abc',data:data});
     all = JSON.stringify(all);
     console.log(all);
     alert(all);
     console.log(JSON.parse(all));

 }
</script>
</html>