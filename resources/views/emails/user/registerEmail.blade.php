@component('mail::message')
# 请验证你的注册验证码

### 这是你的注册验证码 :  {{$code}}

@component('mail::button', ['url' => $url])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}

@endcomponent
