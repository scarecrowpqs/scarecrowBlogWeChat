let App = getApp();

Component({
    data: {
        title: "博文",
        navHeight: App.globalData.navBarHeight,
        showData: "选择菜单选项，显示按钮",
        showContentList:[],
        page: 1,
        limit: 10,
        queryData:{}
    }, // 私有数据，可用于模板渲染

    lifetimes: {
        // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
        attached: function () { },
        moved: function () { },
        detached: function () { },
        ready: function () { 
        }
    },

    // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
    attached: function () { }, // 此处attached的声明会被lifetimes字段中的声明覆盖
    ready: function () { },

    pageLifetimes: {
        // 组件所在页面的生命周期函数
        show: function () {
            if (typeof this.getTabBar === 'function' &&
                this.getTabBar()) {
                this.getTabBar().setData({
                    selected: 0
                })
            }
        },
        hide: function () { },
        resize: function () { },
    },

    methods: {
        onReachBottom: function () {
            let _this = this;
            wx.showLoading({
                title: '加载中....'
            });
            let page = _this.data.page + 1;
            let limit = _this.data.limit;
            let queryData = _this.data.queryData;
            queryData['page'] = page
            _this.getAllArticleList(queryData);
            _this.setData({
                page: page,
                queryData: queryData
            });
        },
        onLoad:function() {
            this.getAllArticleList({});
        },
        searchPage:function(e) {
            let _this = this;
            let data = e.detail;
            data['page'] = 1;
            data['limit'] = 10;
            _this.setData({
                queryData: data,
                page:1
            })
            this.getAllArticleList(data);
        },
        getAllArticleList:function(dataPost) {
            let _this = this;
            App.weiQinAppRequest("GetAllArticle", dataPost, {
                success: function (datas) {
                    let tempDatas = datas.data.data;
                    if (tempDatas.length < 1) {
                        wx.showToast({
                            title: '已加载完所有文章',
                        })
                    }
                    let dataList = [];
                    if (dataPost['page'] != 1) {
                        dataList = _this.data.showContentList;
                    }

                    for (let i in tempDatas) {
                        let data = tempDatas[i];
                        let tempData = {
                            title: data.title,
                            time: data.time,
                            zan: data.zan,
                            read: data.read,
                            href: "/sc_blog/pages/bowen/article/article?id=" + data.aid +"&name="+data.title,
                            imgHref: data.imgHref
                        };
                        dataList.push(tempData);
                    }
                    _this.setData({
                        showContentList: dataList
                    });
                },
                fail: function () { }
            });
        }
    }
})