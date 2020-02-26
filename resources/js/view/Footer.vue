<template>
    <footer class="footer">
        <div class="container">
            <ul>
                <li v-for="record in records">
                    <a v-title="record.name" :alt="record.name" :href="record.url" target="_blank" >
                        <i :class="record.icon" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
            <div class="links">
                <a v-for="link in links" :href="link.url" target="_blank" >{{link.title}}</a>
            </div>
        </div>
        <p  class="p-bottom">
            <a href="http://www.beian.miit.gov.cn/" target="_blank"  v-title="recode">{{recode}}</a>
        </p>
    </footer>
</template>
<script>
    import title from "../src/title";
    export default {
        name: "Footer",
        directives:{
            title
        },
        data() {
            return {
                contactStyle: {
                    paddingRight: '8px'
                },
                records:[
                    {name:'给我发信', url:'/down',icon:'fa fa-paper-plane'},
                    {name:'关注我', url:'https://weibo.com/u/5878370732?is_hot=1',icon:'fa fa-weibo'},
                    {name:'我的github', url:'https://github.com/pl1998',icon:'fa fa-github'},
                ]
                ,
                links:[
                    {
                        title:'友情链接',
                        url:'/likes'
                    },
                    {
                        title:'关于我',
                        url:'/down'
                    }
                ],
                recode:'备案/许可证编号为:赣ICP备19000975号-1'

            }
        }
    }
</script>

<style scoped>
    a:hover, a:focus { color: #e27575; transition: color .15s;}
    .footer-sponsor-link { margin-bottom: 10px;}
</style>
