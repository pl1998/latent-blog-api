<template>
        <div class="row home-content">
            <div class="col-md-1"></div>
            <div class="col-md-10 col-md-offset-1">
                <div v-for="article in articles.data" class="media">
                    <router-link :to="`/article/${article.id}/sssssss`" class="media-left">
                        <img :src="article.cover_img" data-holder-rendered="true">
                    </router-link>
                    <div class="media-body">
                        <h6 class="media-heading">
                            <a href="">{{article.title}}</a>
                        </h6>
                        <div class="meta">
                            <span class="cinema">{{article.description}}</span>
                        </div>
                        <div class="description"></div>
                        <div class="extra">
                            <a v-for="labels in article.label_list" href="">
                                <span class='label btn btn-xs'
                                      v-bind:style="{background:labels.color,color:'#f0f0f0'}"><i class='fa fa-tag'></i>&nbsp;{{labels.label_name}}</span>
                            </a>
                            <div class="info">
                                <i class="el-icon-user"></i>{{article.admin_user.name}}&nbsp;&nbsp;
                                <i class="el-icon-time"></i>{{article.created_at}}&nbsp;&nbsp;
                                <i class="el-icon-view"></i>{{article.review_count}}&nbsp;&nbsp;
                                <a href="http://blog.test/article" class="pull-right">
                                    <router-link :to="`/article/${article.id}/${article.slug}`">Read More <i class='fa fa-mail-forward'></i></router-link>
                                </a>
                                <i class="ion-ios-arrow-forward"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer  remove-padding-horizontal pager-footer">
                    <Pagination :currentPage="currentPage" :total="total" :pageSize="pageSize" :onPageChange="changePage" />
                </div>
            </div>
<!--            <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: block;">Scroll to top</a>-->
        </div>
</template>
<script>
    import Pagination from './Pagination';
    export default {
        name: "Home",
        components:{Pagination},
        data() {
            return {
                articles: [],
                filter: 'default',
                total: 0, // 文章总数
                pageSize: 10, // 每页条数
            }
        },
        //在在内部获取不到外部的this，方法、变量等都获取不到。但是vm.XXXXX可以获取到 在路由加载前取数据
        beforeRouteEnter(to, from, next) {
            next(vm => {
                vm.setDataByFilter(to.query.filter)
            })
        },
        computed: {
            // 当前页，从查询参数 page 返回
            currentPage() {
                return parseInt(this.$route.query.page) || 1
            }
        },
        //通过watch来直接监测demo
        watch: {
            '$route'(to) {
                this.setDataByFilter(to.query.filter)
            }
        },
        methods: {
            setDataByFilter(filter = 'default') {
                // 每页条数
                const pageSize = this.$route.query.page || 1
                // 当前页
                const currentPage = this.currentPage

                //获取所有文章
                axios
                    .get('http://blog.test/api/getArticleList?page='+pageSize)
                    .then(response => {
                        this.articles = response.data;
                        this.total = this.articles.total
                        //this.currentPage = this.articles.current_page
                    });
                this.filter = filter
                // 文章总数

            },
            // 回调，组件的当前页改变时调用
            changePage(page) {
                // axios
                //     .get('http://blog.test/api/getArticleList?page='+page)
                //     .then(response => {
                //
                //         this.articles = response.data;
                //     });
               // this.filter = filter
                this.$router.push({ query: { ...this.$route.query, page } })
                // 文章总数
                // this.total = articles.total
                // this.currentPage = articles.current_page
                }
            }
        }
</script>

<style scoped>

</style>
