<!--
    作者：尤成军
    时间：2016-12-11
    描述：可以输入的下拉框
-->
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8" />
    <script type="text/javascript" src="https://www.helloweba.com/js/jquery.js"></script>

    <style>
        * {
            margin: 0px auto;
            padding: 0px auto;
        }
        body{
            width: 200px;
            height: 80px;
            border: 1px solid;
        }
    </style>
</head>
<body>
<div style="text-align: center;margin-top: 10px;">
    <select id="select" style="width:150px;height:21px;" onchange="a()">

        <option value="1">爬楼高手</option>
        <option value="2" >隔壁老尤条</option>
        <option value="3" >测试3</option>
        <option value="4">测试2</option>
    </select>
    <input id="_input" style="width:130px;height:15px;margin-left:-157px;"  type="text"  />
</div>
<input type="button" onclick="b()" style="margin-top: 10px;margin-left: 100px;" value="显示值" />
</body>
<script>
    $(document).ready(function(){
        if($('#select option:selected').length>1){

            $("#_input").val($("#select option:selected").text());
        }
    });
    function a() {
        $("#_input").val($("#select option:selected").text());

    }
    function b(){
        alert($("#_input").val());
    }
</script>

</html>