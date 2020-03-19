let App = getApp();

Component({
    data: {
        title: "关于",
        navHeight: App.globalData.navBarHeight,
        worksLinkList: [],
        userName:"",
        sex:'',
        articleNum:0,
        worksNum:0 ,
        requestNum:0,
        headeImgUrl:"",
        headBgImgUrl:"/sc_blog/resource/img/about/txbg.jpg"
    }, // 私有数据，可用于模板渲染

    lifetimes: {
        // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
        attached: function () { },
        moved: function () { },
        detached: function () { },
        ready: function () { 
            App.getUserInfo();
        }
    },
    // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
    attached: function () { }, // 此处attached的声明会被lifetimes字段中的声明覆盖
    ready: function () {},

    pageLifetimes: {
        // 组件所在页面的生命周期函数
        show: function () { 
            if (typeof this.getTabBar === 'function' &&
                this.getTabBar()) {
                this.getTabBar().setData({
                    selected: 4
                })
            }
        },
        hide: function () { },
        resize: function () { }
    },
    methods: {
        onLoad: function () {
            let _this = this;
            App.weiQinAppRequest('GetAdminUserInfo', '', {
                success:function(datas) {
                    let data = datas.data.data;
                    _this.setData({
                        userName: data.nickname,
                        sex: data.sex,
                        articleNum: data.artilesNum,
                        requestNum: data.requestNum,
                        headeImgUrl: data.imgurl,
                        worksLinkList: data.worksLinkList,
                        worksNum: data.worksNum
                    });
                },
                fail:function() {
                    wx.showToast({
                        title: '获取管理员信息失败~',
                    })
                }
            });
            App.addRequestLog();
        }
    }
})