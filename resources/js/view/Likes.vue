import swal from "sweetalert2";
<template>
    <div class="row article-content">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="markdown-body">
                <h3>友情链接</h3>
                <div class="likes" v-for="like in likes">
                    <h2 class="animation pulse">
                        <a href="" target="_blank">【{{like.name}}】</a>
                        <span>{{like.signature}}</span>
                    </h2>
                    <h3><button class="btn btn-success" @click="showLikes"><i class="fa fa-ad"></i>添加友链</button></h3>
                </div>
                <div v-if="play"  class="add_likes  animation pulse" enter-active-class="bounceIn" leave-active-class="bounceOut" :duration="{ enter: 200, leave: 400 }">
                    <form  method="post" class="smart-green">

                            <h1>关于友链
                        <i class="fa fa-close" @click="showLikes"></i>
                                <span>Leave your message.</span>
                            </h1>
                            <label>
                                <span>name:</span>
                                <input  id="name" v-validator:input.required="{ regex: /^[a-zA-Z]+\w*\s?\w*$/, error: '用户名要求以字母开头的单词字符' }" type="text"  v-model.trim="name" name="name" class="form-control error" placeholder="Please enter name"/> 
                        <div class="error-msg"></div>
                            </label>
                            <label>
                                <span>email :</span>
                                <input   class="form-control"   v-validator.required="{ regex: /^([a-zA-Z\d])(\w|\-)+@[a-zA-Z\d]+\.[a-zA-Z]{2,4}$/, error: '请输入合格邮箱' }"  v-model.trim="email" id="email" type="email" value="" name="email" placeholder="Please enter email"/>
                        <div class="error-msg"></div>
                            </label>
                            <label>
                                <span>url :</span>
                                <input    class="form-control" v-model.trim="blog_url" type="text" value="" name="blog_url" placeholder="Please enter blog url"/>
                        <div class="error-msg"></div>
                            </label>
                            <label>
                                <span>sign :</span>
                                <input   class="form-control" v-model.trim="signature" id="address" type="text" value="" name="signature" placeholder="About the signature"/>
                        <div class="error-msg"></div>
                            </label>
                            <label>
                                <span>leave words :</span>
                                <textarea   class="form-control"   v-model.trim="content" id="message" name="content"  placeholder="leave a message"></textarea>
                        <div class="error-msg"></div>
                            </label>
                        <div class="success-msg"></div>
                            <label>
                                <span>&nbsp;</span>
                                <input type="button" @click="addLikes" class="button" value="提交"/>
                            </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LikesApi from "../api/likes";

    export default {
        name: "Likes",
        data(){
             return {
                 name:'',
                 email:'',
                 signature:'',
                 content:'',
                 blog_url:'',
                 play: false
             }
        },
        created() {
            this.$store.dispatch('loadLikes');
        },
        computed: {
            likesLoadStatus() {
                return this.$store.getters.getLikesLoadStatus;
            },
            likes() {
                return this.$store.getters.getLikes;
            }
        },
        methods:{
            addLikes(e)
            {
               const  like = {
                   name:this.name,
                   email:this.email,
                   signature:this.signature,
                   blog_url:this.blog_url,
                   content:this.content,
               };
                LikesApi.addLikes(like)
                    .then( function(response){
                        swal({
                            title: "添加成功!",
                            text: "等待邮件通知!",
                            icon: "success",
                        });
                        this.showLikes();
                    })
                    .catch( function(response){
                        swal({
                            title: "添加失败!",
                            text: '请输入合格的参数',
                            icon: "error",
                        });
                    });
            },
            showLikes()
            {
                this.play = !this.play //取反
            }
        }
    }
</script>

<style>
.help-block{
    color:red;
}
</style>
