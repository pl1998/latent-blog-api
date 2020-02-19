<template>
    <div class="blog-login">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 floating-box well">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">登录</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group ">
                            <label class="control-label">邮箱</label>
                            <input type="text" class="form-control" placeholder="请填写邮箱">
                        </div>
                        <div class="form-group">
                            <label class="control-label">密码</label>
                            <input type="password" class="form-control" placeholder="请填写密码">
                        </div>

                        <button type="submit" class="btn  btn-success btn-block">
                             登录
                        </button>
                        <div class="strike">
                            <span>or</span>
                        </div>
                        <div class="form-group">
                            <a @click="githubLogin()" style="color:#fff" class="btn btn-primary form-control"><i class="fa fa-github"></i>  Github 登录</a>
                        </div>
                        <div class="form-group">
                            <router-link :to="`/password/reset`" class="btn form-control reset_pass">忘记密码?</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    ///
    import SimpleMDE from "simplemde";
    import hljs from "highlight.js";

    export default {
        name: "Login",
        data(){
            return {
                name:'',
                email:'',
                call:null
            }
        },
        methods: {
            githubLogin:function () {
               axios
                .get('/api/oauth/github')
                   .then(response => {
                       this.call = response.data;
                       console.log(this.call)
                   });
            }
        }
    }
</script>

<style scoped>

</style>
