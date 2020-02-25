<template>
    <div class="row article-content">
        <div class="col-md-2"></div>
        <div class="col-md-8" style=" background-color: #fff;">
            <div class="markdown-body" ref='content' v-html="article.content" v-highlight></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Article",
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
        }
    }
</script>

<style scoped>
    @import '~highlight.js/styles/custom.css';
</style>
