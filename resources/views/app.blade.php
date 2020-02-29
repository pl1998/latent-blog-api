<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latent</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="Shortcut Icon" href="/images/967592.png" type="image/x-icon" />
</head>
<body>

<div id="app">
    <Categories></Categories>
    <Nav v-if="$route.path.slice(-6)!=='/login' && $route.path.slice(-9)!=='/register' " ></Nav>
    <div class="container">
        <router-view></router-view>
    </div>
    <Footers></Footers>
</div>

<script type="text/javascript" src="{{ mix('js/app.js') }}"></script>


</body>
</html>
