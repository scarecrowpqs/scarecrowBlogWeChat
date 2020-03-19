let App = getApp();

Component({
    data: {
        title: "友链",
        navHeight: App.globalData.navBarHeight,
        windowHeight: App.globalData.windowHeight,
        frendLinkList:[]
    }, 
    lifetimes: {
        // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
        attached: function () { },
        moved: function () { },
        detached: function () { },
        ready: function () { }
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
                    selected: 3
                })
            }
        },
        hide: function () { },
        resize: function () { },
    },

    methods: {
        onLoad:function() {
            let _this = this;
            App.weiQinAppRequest('GetAllFrendsLink', '', {
                success:function(datas) {
                    let data = datas.data.data;
                    _this.setData({
                        frendLinkList: data
                    });
                },
                fail:function() {
                    wx.showToast({
                        title: '获取友链失败',
                    })
                }
            });
        }
    }
})