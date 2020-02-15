<template>
  <div class="container">
      <div class="row home-content">
          <div class="col-md-11 col-md-offset-1">
              <div v-for="article in articlesList" class="media">
                  <a href="" class="media-left">
                      <img :src="article.img" data-holder-rendered="true">
                  </a>
                  <div class="media-body">
                      <h6 class="media-heading">
                          <a href="">{{article.title}}</a>
                      </h6>
                      <div class="meta">
                          <span class="cinema">{{article.detailed}}</span>
                      </div>
                      <div class="description"></div>
                      <div class="extra">
                          <a v-for="label in article.label" href="">
                              <div class="label">
                                  <i class="fa fa-tags"></i>{{label}}
                              </div>
                          </a>
                          <div class="info">
                              <i class="el-icon-user"></i>{{article.name}}&nbsp;&nbsp;
                              <i class="el-icon-time"></i>{{article.created_at}}&nbsp;&nbsp;
                              <i class="el-icon-view"></i>{{article.review}}&nbsp;&nbsp;
                              <a href="http://blog.test/article" class="pull-right">
                                  <router-link :to="{ name: 'article' }">Read More</router-link>
                                  </a>
                              <i class="ion-ios-arrow-forward"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
                articlesList:[
                    {
                        img:'https://cdn.pigjian.com/cover/2018/10/11/mzcJBgfUXAJWC7E4YOqcysOP4L7vXvadI71nSCtS.jpg',
                        title:'Ubuntu 16.04 环境安装部署',
                        detailed:'Five structures and commands',
                        label:[
                            'redis','php'
                        ],
                        name:'latent',
                        created_at:'两年前',
                        review:'200'
                    },
                    {
                        img:'https://cdn.pigjian.com/cover/2018/10/11/mzcJBgfUXAJWC7E4YOqcysOP4L7vXvadI71nSCtS.jpg',
                        title:'Ubuntu 16.04 环境安装部署',
                        detailed:'Five structures and commands',
                        label:[
                            'redis','php'
                        ],
                        name:'latent',
                        created_at:'两年前',
                        review:'200'
                    },
                    {
                        img:'https://cdn.pigjian.com/cover/2018/10/11/mzcJBgfUXAJWC7E4YOqcysOP4L7vXvadI71nSCtS.jpg',
                        title:'Ubuntu 16.04 环境安装部署',
                        detailed:'Five structures and commands',
                        label:[
                            'redis','php'
                        ],
                        name:'latent',
                        created_at:'两年前',
                        review:'200'
                    }
                ]
            }
        }
    }
</script>

<style scoped>

</style>
