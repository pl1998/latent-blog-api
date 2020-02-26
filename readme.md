#### 基于laravel5.8+vue的spa博客
#### 路由使用: vue-route路由

```
   git clone https://gitee.com/pltrue/latent-blog.git
   cd latent-blog
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   npm install
  
   线下使用package.json
   线上将package.example.json 覆盖 package.json
   
   关于开发于生产环境配置
   resources/js/config.js
```
##### 修改 resources/js/config.js 文件

```js
   var api_url ='';
   console.log(process.env.NODE_ENV)
   switch( process.env.NODE_ENV ){
   
       case 'development':
           api_url = 'http://blog.test/api/v1';
           break;
       case 'production':
           api_url = 'https://pltrue.top/api/v1';
           break;
   }
  
   export const ROAST_CONFIG = {
       API_URL: api_url,
   }

```

##### 执行
```shell script
    npm run watch-poll
```


