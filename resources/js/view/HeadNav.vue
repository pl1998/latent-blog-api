<template>
    <div v-if="$route.path.slice(-6)=='/article/:slug'" class="jumbotron text-center head_nav">
        <div class="row">
            <div class="col-md-1 "></div>
            <div class="col-md-10 ">
                <h3>{{this.article.admin_user.title}}</h3>
                <h6>{{this.article.admin_user.description}}</h6>
                <div class="header">
                    <i class="fa fa-user"></i>{{this.article.admin_user.name}}
                    <i class="fa fa-tag"></i>
                    <routes-link :to="`/tag/${label.label_name}`" v-for="label in this.article.label_list" href="">
                        {{label.label_name}}
                    </routes-link>
                    <i class="fa fa-times">{{this.article.created_at}}</i>
                </div>
            </div>
        </div>
    </div>

    <div v-else class="jumbotron text-center head_nav">
        <div class="row">
            <div class="col-md-1 "></div>
            <div class="col-md-10 ">
                <h3>the meaning of life</h3>
                <h6>https://pltrue.top</h6>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "HeadNav",
        data() {
            return {
                article:null
            }
        }
    }
</script>

<style scoped>

</style>
