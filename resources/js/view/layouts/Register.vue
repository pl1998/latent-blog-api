<template>
    <div class="blog-login">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4  floating-box" style="  background-color: #fff;">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">请注册</h3>
                    </div>
                    <div class="panel-body " data-validator-form>
                        <div class="form-group">
                            <label class="control-label">用户名</label>
                            <input type="text"
                                   v-model.trim="username"
                                   v-validator:input.required="{ regex: /^[a-zA-Z]+\w*\s?\w*$/, error: '用户名要求以字母开头的单词字符' }"
                                   class="form-control" placeholder="请填写用户名">
                        </div>
                        <div class="form-group">
                            <label class="control-label">邮箱</label>
                            <input type="text"
                                   v-model.trim="email"
                                   v-validator.required="{ regex: /^([a-zA-Z\d])(\w|\-)+@[a-zA-Z\d]+\.[a-zA-Z]{2,4}$/, error: '请输入合格邮箱' }"
                                   class="form-control" placeholder="请填写邮箱">
                        </div>
                        <div class="form-group">
                            <label class="control-label">密码</label>
                            <input type="password"
                                   id="password" v-model.trim="password"
                                   v-validator.required="{ regex: /^\w{6,25}$/, error: '密码要求 6 ~ 25 个单词字符' }"
                                   class="form-control" placeholder="请填写密码">
                        </div>
                        <div class="form-group">
                            <label class="control-label">确认密码</label>
                            <input v-model.trim="cpassword" type="password"
                                   v-validator.required="{ target: '#password' }" class="form-control"
                                   placeholder="请填写确认密码">
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block" @click="register">
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
                username: '',
                password: '',
                email: '',
                cpassword: '',
                user:''
            }
        },
        methods: {
            register(e) {
                this.$nextTick(() => {
                    const target = e.target.type === 'submit' ? e.target : e.target.parentElement

                    if (target.canSubmit) {
                        this.submit()
                    }
                })
            },
            submit() {
                axios.post('/api/v1/users', {
                    name: this.username,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.cpassword
                })
                    .then(function (response) {
                         this.user = response.data;
                         if(!this.user.message){
                             //注册成功

                         } else {
                             alert(this.user.message);
                         }
                    });

            }
        }
    }
</script>

<style scoped>
    .btn-block {
        margin: 0 0 20px 0;
    }
</style>
