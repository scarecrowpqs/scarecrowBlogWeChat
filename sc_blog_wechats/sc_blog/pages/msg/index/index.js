let App = getApp();

Component({
    data: {
        title: "留言",
        navHeight: App.globalData.navBarHeight,
        page:1,
        limit:10,
        allMsgList:[]
    }, // 私有数据，可用于模板渲染

    lifetimes: {
        // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
        attached: function () { 
        },
        moved: function () { },
        detached: function () { },
        ready: function () {
        }
    },

    // 生命周期函数，可以为函数，或一个在methods段中定义的方法名
    attached: function () { }, // 此处attached的声明会被lifetimes字段中的声明覆盖
    ready: function () { 

    },

    pageLifetimes: {
        // 组件所在页面的生命周期函数
        show: function () {
            if (typeof this.getTabBar === 'function' &&
                this.getTabBar()) {
                this.getTabBar().setData({
                    selected: 2
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
            _this.getMsgList(page, limit, false);
            _this.setData({
                page: page
            });
        },
        sendMsg:function(e){
            let userInfo = App.getUserInfo();
            if (userInfo === false) {
                return ;
            }

            let dataStr = e.detail.replace(/\s+/g, " ");
            console.log(dataStr)
            if(dataStr == " " || dataStr == ""){
                wx.showToast({
                    title: '留言内容不能为空',
                });
                return false;
            }
            let _this = this;
            wx.showLoading({
                title: '加载中....'
            });
            App.weiQinAppRequest('AddMsg', { msg: dataStr }, {
                success: function (datas) {
                    wx.hideLoading();
                    let data = datas.data;
                    if (data.data.code == 0) {
                        let userInfo = App.userInfo;
                        let tempData = {
                            id: data.data.id,
                            userName: userInfo.nickName,
                            userImgHref: userInfo.avatar,
                            userSayStr: dataStr,
                            addTimes: data.data.times
                        };
                        let tempDatas = _this.data.allMsgList;
                        tempDatas.splice(0, 0, tempData);
                        _this.setData({
                            allMsgList: tempDatas
                        });
                        wx.showToast({
                            title: '发布成功',
                        })
                        return ;
                    }
                    if (data.data.code == 1) {
                        App.showLoginPage();
                        return ;
                    }
                }
            });
        },
        onLoad: function () {
            let page = this.data.page;
            let limit = this.data.limit;
            this.getMsgList(page, limit);
        },
        getMsgList: function (page, limit, isFirst = true) {
            let _this = this;
            App.weiQinAppRequest('GetAllMsg', { page: page, limit: limit }, {
                success: function (datas) {
                    if (!isFirst) {
                        wx.hideLoading();
                    }
                    let data = datas.data.data;
                    let allMsgList = _this.data.allMsgList;
                    if (data.length < 1) {
                        wx.showToast({
                            title: '所有留言已加载完毕...'
                        });
                        if (!isFirst) {
                            wx.hideLoading();
                        }
                        return;
                    }
                    _this.setData({
                        allMsgList: [...allMsgList, ...data]
                    });

                },
                fail: function () {
                    if (!isFirst) {
                        wx.hideLoading();
                    }
                    wx.showToast({
                        title: '获取留言列表错误',
                    });
                }
            });
        }
    }
})