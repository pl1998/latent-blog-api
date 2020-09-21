<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="Shortcut Icon" href="/images/967592.png" type="image/x-icon" />
</head>
<body style="background-color:#8196ac">
<div class="container">
   <div style=" position: absolute; top: 100px; left: 35%; height: 300px;width: 500px;background-color: #fff;padding: 8px 8px 15px 8px">
       <form class="form-group">
           <div class="form-group">
               <label>用户</label>
               <input type="text" class="form-control">
           </div>
           <div class="form-group">
               <label>密码</label>
               <input type="password" class="form-control">
           </div>

           <div class="form-group">
               <button type="button" class="btn btn-success">登录</button>
               <button type="button" class="btn btn-danger">注册</button>
               <hr>
               <p style="text-align: center">第三方登录</p>
               <a style="margin-right: 40px" onclick="qqlogin()"><img src="{{asset('Connect_logo_7.png')}}"></a>
           </div>
       </form>
   </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.bootcss.com/qs/6.5.2/qs.min.js"></script>

<script>

    function qqlogin()
    {

    },

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
