<?php

return [
    'wb_key'=>'1949419161',
    'wb_secret'=>'38ad194c8302f42d8d6c7bc7704595e7',
    'wb_callback_url'=>'https://api.pltrue.top/weibo/login',
    'authorize_url'=>'https://api.weibo.com/oauth2/authorize?client_id=%s&response_type=code&redirect_uri=%s',
    'access_token_url'=>'https://api.weibo.com/oauth2/access_token?client_id=%s&client_secret=%s&grant_type=authorization_code&redirect_uri=%s&code=%s',
    'access_user'=>'https://api.weibo.com/2/users/show.json',
];
