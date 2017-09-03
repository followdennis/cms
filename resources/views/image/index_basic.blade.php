<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>图片上传</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
    <style>

        .center {
            display: table;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<div class="row">
    <form action="{{ url('image_upload') }}" method="post" enctype="multipart/form-data" class="col-md-4 col-md-offset-4">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="file">Filename:</label>
            <input type="file" name="file1" id="file1" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="submit">提交表单</label>
            <input type="submit" name="submit" value="Submit"  class="form-control blue btn-primary"/>
        </div>
    </form>
</div>

</body>
</html>