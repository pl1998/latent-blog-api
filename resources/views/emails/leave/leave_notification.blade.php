@component('mail::message')
# 有人给你留言啦~~~
## Hi,  {{ config('app.name') }}
### 留言内容 :  {{$content}}

### ----------
#### 留言邮箱:
   Thanks,<br>
## {{$name}}    <br/>
## 时间： {{date('Y-m-d H-i-s')}}

@endcomponent
