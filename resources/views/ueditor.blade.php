<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
    <script>



    </script>
    {{--生成二维码的js插件--}}
    <script type="text/javascript" src="https://www.helloweba.com/js/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.qrcode.min.js') }}"></script>
    <script>
        $(document).ready(function(){


        })
    </script>
@include('vendor.ueditor.assets')

    <!-- 编辑器容器 -->
</head>
<body>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    for( var i = 1; i<= '{{ $num }}'; i++){
        var ue = UE.getEditor('container'+i,{
            //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个
            toolbars:[[
                'fullscreen',  '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'cleardoc', '|',
                 'lineheight', '|',
                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                'simpleupload', 'insertimage', 'emotion',   'insertcode',  'template', 'background', '|',
                'horizontal', 'date', 'time', 'spechars', 'snapscreen',  '|',
                'inserttable', 'deletetable',  '|',
                'preview', 'searchreplace'
            ]],
            //focus时自动清空初始化时的内容
            autoClearinitialContent:true,
            //关闭字数统计
            wordCount:false,
            //关闭elementPath
            elementPathEnabled:false,
            //默认的编辑区域高度
            initialFrameHeight:300
            //更多其他参数，请参考ueditor.config.js中的配置项

        });
        initialFrameWidth : '500px';//文本框宽和高
        initialFrameHeight : 350;//文本框宽和高
        autoHeight:false;
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    }

</script>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
           ueditor使用
        </div>

        <div>
            <div id="code"></div>
            <div>

            </div>
        </div>
        @for( $i = 1 ; $i <= $num; $i++)
        <form action="ueditor" method="post">
            {{ csrf_field() }}
            <script id="container{{$i}}" name="content" type="text/plain" style="width:400px;"></script>
            <button type="submit">提交</button>
        </form>
        @endfor
        <div class="links" >
        </div>
    </div>
</div>
</body>
</html>
