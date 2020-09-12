<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form class="form-group">
    <button type="button" class="btn btn-danger" onclick="login()">github</button>
</form>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.bootcss.com/qs/6.5.2/qs.min.js"></script>

<script>

    function login()
    {
        window.open('https://gitee.com/oauth/authorize?client_id=7e22fbb0ff807dd9768b88c5e4a89b92dedf4291e62ae395e5534b6f77122dde&redirect_uri=https://api.pltrue.top/oauth/giteeCallback&response_type=code')
        window.addEventListener('message', function (e) {
            //开始登录
            console.log(e)
        }, false)
    }
</script>
</body>
</html>
