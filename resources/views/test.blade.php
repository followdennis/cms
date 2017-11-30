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
        var  url = {
            list:{
                fetch:'{{ route('regular_test') }}',
            }
        };

        //http://www.cms.cc/regular_test
        var jsRoute = function jsRoute(routeUrl,param){
            var append = [];
            for(var x in param){
                var search = '{'+x+'}';
                if(routeUrl.indexOf(search) >= 0){
                    routeUrl = routeUrl.replace('{'+x+'}',param[x]);
                }else{
                    append.push( x + '=' + param[x]);
                }
            }
//                var url = '/'+_.trimStart(routeUrl,'/');

            var url = routeUrl;
            if(append.length == 0){
                return url;
            }
            if(url.indexOf('?') >=0){
                url +='&';
            }else{
                url += '?';
            }
            url += append.join('&');
            return url;
        }
        var mark = {
            name:'aaa',
            age:20
        };
        var content = document.createElement('div');
        content.innerHTML = '宝岛台湾';
        content.className = 'taiwan';
        mark.name = 'bbb';
        mark.content = content;
        console.log(mark);

    </script>
    {{--生成二维码的js插件--}}
    <script type="text/javascript" src="https://www.helloweba.com/js/jquery.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.qrcode.min.js') }}"></script>
    <script>
        $(document).ready(function(){


        })
    </script>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Hello Laravel

        </div>
        <div>
            <img src='{{ asset('images/2016071510134013733.jpg') }}' />
            <div id="code"></div>
            <div>

            </div>
        </div>
        <div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
        </div>
    </div>
</div>
</body>
</html>