<html>
<head>
    <title>表格数据插入</title>
    <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script  type='text/javascript' src="{{ asset('vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
    <link rel='stylesheet' type='text/css' href="{{ asset('vendor/bootstrap/dist/css/bootstrap.css') }}">
</head>
<body>
<div class="container">
    <form>
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">date</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="date">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>
</body>
</html>