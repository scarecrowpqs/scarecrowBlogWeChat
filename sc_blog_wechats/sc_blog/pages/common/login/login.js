let App = getApp();
Page({

    /**
     * 页面的初始数据
     */
    data: {
        title: "用户登录",
        navHeight: App.globalData.navBarHeight,
        canIUse: wx.canIUse('button.open-type.getUserInfo')
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
    },

    /**
     * 生命周期函数--监听页面初次渲染完成
     */
    onReady: function () {

    },

    /**
     * 生命周期函数--监听页面显示
     */
    onShow: function () {
    },

    /**
     * 生命周期函数--监听页面隐藏
     */
    onHide: function () {

    },

    /**
     * 生命周期函数--监听页面卸载
     */
    onUnload: function () {

    },

    /**
     * 页面相关事件处理函数--监听用户下拉动作
     */
    onPullDownRefresh: function () {

    },

    /**
     * 页面上拉触底事件的处理函数
     */
    onReachBottom: function () {

    },

    /**
     * 用户点击右上角分享
     */
    onShareAppMessage: function () {

    },
    bindGetUserInfo:function(datas){
        if (datas.detail.errMsg == "getUserInfo:ok") {
            App.util.getUserInfo((userInfo)=>{
                App.userInfo = {
                    avatar: userInfo.wxInfo.avatarUrl,
                    nickName: userInfo.wxInfo.nickName,
                    isCanUse:true
                };
            });
        } else {
            wx.showModal({
                title: '用户登录申请',
                content: '你拒绝了登录申请，你将不能使用留言功能!',
            });
        }
        wx.navigateBack({
            delta: 1
        });
    }
})