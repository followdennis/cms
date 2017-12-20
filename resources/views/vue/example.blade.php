<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="X-CSRF-TOKEN" content="{{csrf_token()}}">
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">

    <title>123</title>
</head>
<body>
<div id="app">
    <div>
        <app></app>
        <user-form></user-form>
    </div>
    <ul>
        {{--<todo-item--}}
                {{--v-for="item in groceryList"--}}
                {{--v-bind:todo="item"--}}
                {{--v-bind:key="item.id">--}}
        {{--</todo-item>--}}
    </ul>
</div>


<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>