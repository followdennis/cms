<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>vueform</title>
    <meta name="X-CSRF-TOKEN" content="{{csrf_token()}}">
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div id="app">
<h2>表单数据</h2>
    <user-form></user-form>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>