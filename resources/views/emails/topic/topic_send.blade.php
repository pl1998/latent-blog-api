@component('mail::message')
# {{$name}} 评论了你的文章

### 你的文章评论了 :  {{$content}}

@component('mail::button', ['url' => $url])
点击查看详情
@endcomponent

{{$email}} <br>
{{ config('app.name') }}

@endcomponent
<?php
