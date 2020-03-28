<template>
    <div class="row article-content">
        <div class="col-md-2"></div>
        <div class="col-md-8" style=" background-color: #fff;">
            <div class="markdown-body" ref='content' v-html="article.content" v-highlight></div>
            <div class="markdown-body">
                <div v-if="play" class="publishing alert alert-dismissible alert-info" >
                    <button type="button" @click="tragent" data-dismiss="alert" class="close">x</button>
                    由 Latent 创作，采用 知识共享 署名-非商业性使用 4.0 国际 许可协议进行许可。基于https://pltrue.top上的作品创作。
                    本站文章除注明转载/出处外，均为本站原创或翻译，转载前请务必署名。 最后编辑时间:{{article.updated_at}}
                </div>
                <div  class="publishing alert alert-dismissible alert-info" >
                    <h5>评论已关闭</h5>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        name: "Article",
        data() {
            return {
                play:true,
            }
        },
        created() {
          this.$store.dispatch('loadArticle', this.$route.params);
        },
        computed: {
            articleLoadStatus() {
                return this.$store.getters.getArticleLoadStatus;
            },
            article() {
                 return this.$store.getters.getArticle;
            }
        },
        methods:{
            tragent()
            {
                this.play = !this.play //取反
            }
        }
    }
</script>

<style scoped>
    @import '~highlight.js/styles/custom.css';
</style>
