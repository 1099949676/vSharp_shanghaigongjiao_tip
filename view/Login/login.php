<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>请你登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        form{margin: 15px;}
    </style>
</head>
<body>
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email"
                   placeholder="请输入邮箱">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">确认</button>
        </div>
    </div>

    <script>

        $('.btn-default').click(function(){

            var email=$("[name=email]").val();

            if(!email){
                alert("邮箱不能为空！");
                return;
            }

            if(!isEmail(email)){
                alert("邮箱格式不正确！");
                return;
            }

            window.location.href="?controller=Login&action=sendTmpToken&email="+email;

        });


        function isEmail(str){
            var reg=/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((.[a-zA-Z0-9_-]{2,3}){1,2})$/;
            return reg.test(str);
        }

    </script>
</form>
</body>
</html>