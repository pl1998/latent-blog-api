<template>
    <div class="row article-content">
        <div class="col-md-2"></div>
        <div class="col-md-8" style=" background-color: #fff;">
            <div class="markdown-body" v-html="content"></div>
        </div>
    </div>
</template>

<script>
    import SimpleMDE from 'simplemde'
    import hljs from 'highlight.js'
    export default {
        name: "Article",
        data() {
            return {
                article: null,
                content:'',
            }
        },
        created() {
            this.articlesListData();
        },
        methods: {
            articlesListData() {
                this.error = this.article = null
                axios.get('http://blog.test/api'+this.$route.path)
                    .then(response => {
                        this.article = response.data;
                            this.content = SimpleMDE.prototype.markdown(this.article.content);
                        this.$nextTick(() => {
                            this.$el.querySelectorAll('pre code').forEach((el) => {
                                hljs.highlightBlock(el)
                            })
                        });
                    });
            },
        }
    }
</script>

<style scoped>
    @import '~highlight.js/styles/custom.css';
</style>
