<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latent</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="Shortcut Icon" href="/images/967592.png" type="image/x-icon" />
</head>
<body>
<div>登陆中...</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    window.onload = function () {
        window.opener.postMessage("bearer {{ $token }}", "{{ $domain }}");
        window.close();
    }
</script>
</body>
</html>
