@component('mail::message')
    #文章标题 {{$title}}

    ### 文章内容 :  {{$description}} .....

    @component('mail::button', ['url' => $url])
        点击查看详情
    @endcomponent

    {{$email}} <br>
    {{ config('app.name') }}

@endcomponent
<?php
