<template>
    <div class="blog-login">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4  floating-box well">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">请注册</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">用户名</label>
                        <input type="text" name="name" class="form-control" placeholder="请填写用户名">
                    </div>
                    <div class="form-group">
                        <label class="control-label">邮箱</label>
                        <input type="text" name="email" class="form-control" placeholder="请填写邮箱">
                    </div>
                    <div class="form-group">
                        <label class="control-label">密码</label>
                        <input type="password" name="password" class="form-control" placeholder="请填写密码">
                    </div>
                    <div class="form-group">
                        <label class="control-label">确认密码</label>
                        <input type="password" name="confirm_password" class="form-control" placeholder="请填写确认密码">
                    </div>
                    <button type="submit" class="btn btn-lg btn-success btn-block">
                        注册
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "Register",
        data() {
           return {
               name:'',
               email:'',
           }
        }
    }
</script>

<style scoped>

</style>
