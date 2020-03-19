var util = require('we7/resource/js/util.js');
App({
    onLaunch: function (res) {
        this.initGetSystemInfo();
        this.getUserInfo();
    },
    onShow: function (res) {
   
    },
    onHide: function () {
    },
    onError: function (msg) {
        console.log(msg)
    },
    //加载微擎工具类
    util: util,
    //导航菜单，微擎将会自己实现一个导航菜单，结构与小程序导航菜单相同
    //用户信息，sessionid是用户是否登录的凭证
    userInfo: {
        avatar: null,
        nickName: null,
        isCanUse: false
    },
    siteInfo: require('siteinfo.js'),
    menuList: require('menu.js'),
    printLog:function(obj) {
        console.log(obj);
    },
    //全局变量
    globalData:{
      windowWidth:0,
      windowHeight:0,
      titleBarHeight:44,
      statusBarHeight:0,
      navBarHeight:0
    },
    initGetSystemInfo:function() {
      let _this = this;
      if (_this.globalData.navBarHeight == 0) {
        wx.getSystemInfo({
          success: function (res) {
            _this.globalData.windowWidth = res.windowWidth;
            _this.globalData.windowHeight = res.windowHeight;
            _this.globalData.statusBarHeight = res.statusBarHeight;
            _this.globalData.navBarHeight = _this.globalData.titleBarHeight + _this.globalData.statusBarHeight;
          },
          fail:function(){
            wx.showToast({
              title: '获取手机信息失败，请退出重启',
            })
          }
        })
      }
    },
    weiQinAppUrl:function(apiName, data, m="sc_blog") {
        data['m'] = m;
        let url = this.util.url("entry/wxapp/"+apiName, data);
        return url;
    },
    weiQinAppRequest: function (apiName, data, setting) {
        let tempset = {
            url: "entry/wxapp/" + apiName,
            data: data
        }
        

        if (setting && typeof setting === "object") {
            for (let i in setting) {
                tempset[i] = setting[i];
            }
        } else {
            return false;
        }

        this.util.request(tempset);
        return true;
    },
    getUserInfo:function() {
        var _this = this;
        if (_this.userInfo.isCanUse) {
            return _this.userInfo;
        }

        wx.getSetting({
            success(res) {
                if (res.authSetting['scope.userInfo']) {
                    // 已经授权，可以直接调用 getUserInfo 获取头像昵称
                    wx.getUserInfo({
                        success: function (res) {
                            _this.userInfo = {
                                avatar: res.userInfo.avatarUrl,
                                nickName: res.userInfo.nickName,
                                isCanUse: true
                            };
                        },
                        fail: function() {
                            _this.userInfo = {
                                isCanUse:false
                            };
                        }
                    })
                } else {
                    _this.showLoginPage();
                }
            }
        })

        return false;
    },
    getNowTimestamp:function(){
        var timestamp = Date.parse(new Date());
        timestamp = timestamp / 1000;
        return timestamp;
    },
    getNowTime:function(format = "Y-m-d H:i:s") {
        var date = new Date();
        //年  
        var Y = date.getFullYear();
        //月  
        var m = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1);
        //日  
        var d = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
        //时    
        var H = date.getHours() < 10 ? '0' + date.getHours() : date.getHours();
        //分    
        var i = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
        //秒    
        var s = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
        format = format.replace("Y", Y);
        format = format.replace("m", m);
        format = format.replace("d", d);
        format = format.replace("H", H);
        format = format.replace("i", i);
        format = format.replace("s", s);
        return format;
    },
    addRequestLog: function () {
        let obj = wx.getLaunchOptionsSync();
        this.weiQinAppRequest('AddRequestLog', { scene: obj.scene}, {
            success:function(datas){}
        });
    },
    showLoginPage:function() {
        wx.navigateTo({
            url: '/sc_blog/pages/common/login/login',
        });
    }
});