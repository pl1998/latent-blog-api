<template>
    <footer class="footer">
        <div class="container">
            <ul>
                <li><a v-title="records.paper" :alt="records.paper" href=""><i class="fa fa-paper-plane" aria-hidden="true"></i></a> </li>
                <li><a v-title="records.weibo" :alt="records.weibo" href=""><i class="fa fa-weibo" aria-hidden="true"></i></a> </li>
                <li><a v-title="records.github" :href="records.github" ><i class="fa fa-github" aria-hidden="true"></i></a> </li>
            </ul>

            <div class="links">
                <a v-for="link in links" :href="link.url">{{link.title}}</a>
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
                    {
                        paper:'xxxx',
                        weibo:'xxxx',
                        github:'https://github.com/pl1998',
                    }
                ]
                ,
                links:[
                    {
                        title:'友情链接',
                        url:''
                    },
                    {
                        title:'关于我',
                        url:''
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
