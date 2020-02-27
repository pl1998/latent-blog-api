<template>
    <div class="row home-content">
        <div class="col-md-1"></div>
        <div class="col-md-10 col-md-offset-1">
            <div v-for="article in articles.data" class="media animated pulse">
                <div class="row">
                        <router-link :to="`/article/${article.id}/${article.slug}`" class="media-left">
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
                                    <i class="fa fa-user"></i>{{article.admin_user.name}}&nbsp;&nbsp;
                                    <i class="fa fa-clock-o"></i>{{article.created_at}}&nbsp;&nbsp;
                                    <i class="fa fa-eye"></i>{{article.review_count}}&nbsp;&nbsp;
                                    <a href="http://blog.test/article" class="pull-right">
                                        <router-link :to="`/article/${article.id}/${article.slug}`">Read More <i class='fa fa-mail-forward'></i></router-link>
                                    </a>
                                    <i class="ion-ios-arrow-forward"></i>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="panel-footer  remove-padding-horizontal pager-footer">
                <Pagination :currentPage="currentPage" :total="total" :pageSize="parseInt(pageSize)" :onPageChange="changePage"/>
            </div>
        </div>
    </div>
</template>
<script>
    import Pagination from './Pagination';
    export default {
        name: "Home",
        created() {
            this.$store.dispatch('loadArticles',this.$route.query.page);
        },
        components: {Pagination},
        watch: {
            '$route'(to) {
              this.getArticles('watch');
            }
        },

        computed: {
            articlesLoadStatus(){
                return this.$store.getters.getArticlesLoadStatus;
            },
            articles(){
                 return   this.getArticles('computed');

            },
            currentPage() {
                return parseInt(this.$route.query.page) || 1
            },
            total()
            {
                return this.$store.getters.getTotal;
            },
            pageSize()
            {
                return this.$store.getters.getPageSize;
            }
        },
        methods: {
            changePage(page) {
                this.$router.push({query: {...this.$route.query, page}})
            },
            getArticles(method)
            {
                if(method === 'watch') {
                   const page = parseInt(this.$route.query.page) || 1;
                    this.$store.dispatch('loadArticles',page);
                    return this.$store.getters.getArticles;
                }else {
                    return this.$store.getters.getArticles;
                }
            }
        }
    }
</script>

<style scoped>

</style>
