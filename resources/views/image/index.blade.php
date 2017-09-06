<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>图片上传 | cookie</title>
    <link rel="stylesheet" href="{{ asset("css/jquery.fileupload.css") }}">
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
</head>
<body>
  file: <input type="file" id="images" name="image" /><br><br>
  desc: <input type="text" id="desc" name="desc" /><br><br>
 上传测试<input type="file" id="fileupload" name="files[]" multiple>
  <input type="button" value="upload" >
  

<div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>
<!-- The container for the uploaded files -->
<div id="files" class="files"></div>
  <div class="images"></div>
  <div id="app"></div>



<script type="text/javascript" src="{{ asset("js/app.js") }}"></script>
<script type="text/javascript" src="{{ asset("js/vendor/jquery.ui.widget.js") }}"></script>

<script type="text/javascript" src="{{ asset("js/jquery.iframe-transport.js") }}"></script>
<script type="text/javascript" src="{{ asset("js/jquery.fileupload.js") }}"></script>




<script type="text/javascript">
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'server/php/';
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                        'width',
                        progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>
</body>
</html>