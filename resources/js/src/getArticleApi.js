// 返回使用 filter 参数过滤后的所有文章
export const getArticlesByFilter = (state, getters) => (filter) => {
    // 使用派生状态 computedArticles 作为所有文章
    let articles = getters.computedArticles

    let filteredArticles = []

    axios
        .get('http://blog.test/api/getArticleList')
        .then(response => {

            this.articles = response.data;
        });
    //过滤机制
    // if (Array.isArray(articles)) {
    //     // 深拷贝 articles 以不影响其原值
    //     filteredArticles = articles.map(article => ({ ...article }))
    //
    //     switch(filter) {
    //         case 'excellent':
    //             // 将当前用户的文章设置为精华文章
    //             filteredArticles = getters.getArticlesByUid(1)
    //             break
    //         case 'vote':
    //             // 将赞的最多的文章排在前面
    //             filteredArticles.sort((a, b) => {
    //                 const alikeUsers = Array.isArray(a.likeUsers) ? a.likeUsers : []
    //                 const blikeUsers = Array.isArray(b.likeUsers) ? b.likeUsers : []
    //
    //                 return blikeUsers.length - alikeUsers.length
    //             })
    //
    //             break
    //         case 'recent':
    //             // 将最新写的文章排在前面
    //             filteredArticles.reverse()
    //             break
    //         case 'noreply':
    //             // 将评论最少的文章排在前面
    //             filteredArticles.sort((a, b) => {
    //                 const aComments = Array.isArray(a.comments) ? a.comments : []
    //                 const bComments = Array.isArray(b.comments) ? b.comments : []
    //
    //                 return aComments.length - bComments.length
    //             })
    //
    //             break
    //         default:
    //             // 默认将回复时间最新的文章排在前面
    //             filteredArticles.sort((a, b) => {
    //                 const aComments = Array.isArray(a.comments) ? a.comments : []
    //                 const bComments = Array.isArray(b.comments) ? b.comments : []
    //                 const aCommentsLength = aComments.length
    //                 const bCommentsLength = bComments.length
    //
    //                 if (aCommentsLength > 0) {
    //                     if (bCommentsLength > 0) {
    //                         return new Date(bComments[bCommentsLength - 1].date) - new Date(aComments[aCommentsLength - 1].date)
    //                     } else {
    //                         return -1
    //                     }
    //                 } else {
    //                     return 1
    //                 }
    //             })
    //
    //             break
    //     }
    // }

    return filteredArticles
}
