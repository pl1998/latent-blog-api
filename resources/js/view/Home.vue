<template>
    <div class="row home-content">
        <div class="col-md-1"></div>
        <div class="col-md-10 col-md-offset-1">
            <div v-for="article in articles.data" class="media">
                <routes-link :to="`/article/${article.id}/${article.slug}`" class="media-left">
                    <img :src="article.cover_img" data-holder-rendered="true">
                </routes-link>
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
                                <routes-link :to="`/article/${article.id}/${article.slug}`">Read More <i class='fa fa-mail-forward'></i></routes-link>
                            </a>
                            <i class="ion-ios-arrow-forward"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer  remove-padding-horizontal pager-footer">
<!--                <Pagination :currentPage="currentPage" :total="total" :pageSize="pageSize" :onPageChange="changePage"/>-->
            </div>
        </div>
    </div>
</template>
<script>
    import Pagination from './Pagination';
    export default {
        name: "Home",
        //引入组件
        components: {Pagination},
        data() {
            return {
                articles: null,
                total: 0, // 文章总数
                pageSize: 10, // 每页条数
            }
        },
        // beforeRouteEnter(to, from, next) {
        //     next(vm => {
        //         vm.setDataByFilter(to.query.filter)
        //     })
        // },
        created() {
             this.$store.dispatch('loadArticles');
             this.getArticles();
        },
        computed: {
            //获取加载状态
            ArticlesLoadStatus(){
                return this.$store.getters.getArticlesLoadStatus;
            },
            //获取文章article
            articles(){
                return this.$store.getters.getArticles;
            }
            // currentPage() {
            //     return parseInt(this.$route.query.page) || 1
            // }
        },
        //通过watch来直接监测demo
        watch: {
            "$route": "getArticles"
            // '$route'(to) {
            //     this.setDataByFilter(to.query.filter)
            // }

        },
        methods: {
            // setDataByFilter(filter = 'default') {
            //     const pageSize = this.$route.query.page || 1
            //     const currentPage = this.currentPage
            //     axios
            //         .get('/api/getArticleList?page=' + pageSize)
            //         .then(response => {
            //             this.articles = response.data;
            //             this.total = this.articles.total
            //         });
            //     this.filter = filter
            //
            // },
            // changePage(page) {
            //     this.$routes.push({query: {...this.$route.query, page}})
            // },
            // getArticles(){
            //
            // }
        },
    }
</script>

<style scoped>

</style>
