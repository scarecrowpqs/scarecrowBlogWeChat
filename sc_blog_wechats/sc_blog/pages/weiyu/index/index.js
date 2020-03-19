let App = getApp();

Component({
    data: {
        title: "微语",
        navHeight: App.globalData.navBarHeight,
        windowHeight: App.globalData.windowHeight,
        page:1,
        limit:10,
        weiyuList:[]
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
                    selected: 1
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
            _this.getWeiYuList(page, limit, false);
            _this.setData({
                page: page
            });
        },
        onLoad:function() {
            let page = this.data.page;
            let limit = this.data.limit;
            this.getWeiYuList(page, limit);
        },
        getWeiYuList: function (page, limit, isFirst=true) {
            let _this = this;
            App.weiQinAppRequest('GetAllWeiYu', {page:page,limit:limit}, {
                success:function(datas) {
                    if (!isFirst) {
                        wx.hideLoading();
                    }
                    let data = datas.data.data;
                    let weiyuList = _this.data.weiyuList;
                    if (data.length < 1) {
                        wx.showToast({
                            title: '所有微语已加载完毕...'
                        });
                        if (!isFirst) {
                            wx.hideLoading();
                        }
                        return ;
                    }

                    _this.setData({
                        weiyuList: [...weiyuList, ...data]
                    });
                },
                fail:function() {
                    if (!isFirst) {
                        wx.hideLoading();
                    }
                    wx.showToast({
                        title: '获取微语列表错误',
                    });
                }
            });
        }
    }
})