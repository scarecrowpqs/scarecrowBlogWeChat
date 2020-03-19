// sc_blog/pages/bowen/article/article.js
let App = getApp();
Page({

    /**
     * 页面的初始数据
     */
    data: {
        title:"文章详情",
        query:"",
        navHeight: App.globalData.navBarHeight,
        createTime:"",
        readNum:0,
        zanNum:0,
        showContent:"",
        eyeImg: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACwklEQVRYR+2WTWjUUBDH/5NEhFVRBJFWtAiCClKsINVb/UBQEMSL9VYo7qFsmkk9eFFUFESo+ya7e/AD0YMgXsSDJ/HzVES0Ch4UBFGpFUEPgsLKNk+eJCWm2bpthUXY3PKSN/N7/5n5J4QmX9Tk/GgBtBT4fxUoFAqrbdveaaZoYmLibqVSeTubiZqRAp7n9QPoI6LNAN4AeBwl7QawRmv9BMDVIAguNwrTEAAz5wHsBzBCRM9t2x6pVquLHMfp1Fp3EtEIgLEIYiOArQBuisjFv4FMC+D7/lKt9Z1I5kPlcnk0n8/Py+VySmvdTkQvADwioi1a6zMAAhHhwcHBHZZlnTX7iGiXUuprPZC6AMx8EMAJAOfik3ie101E18Iw7C2VSk/TQZn5CoA9IrLcPIuUO2ziiMj1LIhMgGijWJa1tlgsfog3MnNNRJysQJ7njQdB0MbMHwFcEJGT5r1CobDOcZxnROQqpab0xhQAz/MOENExEdmQTMTM2rKsvcVi8XZqvUdEHjLzdxFZwMx9ADpMXyilfpcvUuMlgKMiciu5/w8AZt4eSd6VPqXv+z+UUrlEQA3gm4gsZuZPAH6aiQRQBdALYLeImL6YvJh5FIBvgOPFSQBm7gHwAEC7iIxnAFSVUvPjdd/33yulViWA3olIR3TaJQDOi4gBSQK0ATAl2hZDzBqAmcdEZEUWEDPPHCAiNyooEWm0BKbuC5n5i+M464eHhz9HcYwX1CvBYRG5P6UECSn3ATg90yZMSu37/oBxynQTaq1PBUFwo24TJuTs11qXa7Xapkql8ioBV3cM43dc111m2/ZAPIZDQ0MrwzB8bWwhyxn/tREdB2CSz82IEkpMWnEYhkdKpdK9RqzYdd0u27YvmTiztuLU+DTnY5T2gqZ9jtMg5r4pPyRZIHNda+iHZK5JptvfAmgp0HQFfgGzuoIwIcN5igAAAABJRU5ErkJggg==",
        zanImg: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACCElEQVRYR+2Vv2sUQRTH35uzcQk2NmqlRRoDVvkDRCxshSDYGKuEKLE4bt5sKsdy3hQHQUhhk1r/ABHyo7NRi4Bd/gILA2cUu3kyYQ8u4XZm964Iwi5ss+/H97PfmXmDcMkPXrI+dACdA/+HA8wsF07LCRFdn/zGzD8B4Gr1noWIKPuD2YQorpRaHgwG38aC1tqFoihOxwIxBxEXtNZ/Yo73fhcAdkXkMAeRBGDmHSLamDYrvPevAeC4ii1qrd9M5lVxEJEbdT1ifg5gm4he1Q0rZj4EgK9EpKflMPNHEflhjHle1yMJ4Jw7NsYsJgAOiOhBXTy6EEJYN8bcmgkgrm1qDZn5LSJe01o/q3HgOwAspXrkliAJkLtHogMiYucBcERkckKpeM7FpAPe+3si8oiIeBaIan68IKKdmfZALGLmPQD4QkRbbSDiBo4nxBjzNFWXHUQVxC8ReWyM2W8C4ZxbRsRPF6fltNpGABXENiKuaK1rj5S19kpRFOuIeFdr/bIJbGOAcbN49EIIR2VZvpsUcM6tKqVu93o97vf7f5uIZydhasCIyH0AuBNC2FRKbYYQbFmWn5sKj/NaOzApMBwOb45Go1Nr7e+2wucAply3s/ZrVRcHFDLzGgA8JKInrarnTGbm9wCwd7YEzrkVRPwwZ89W5Yho4xU+1x5opViT3AF0DnQO/AM69swl4GFHPgAAAABJRU5ErkJggg=="
    },

    /**
     * 生命周期函数--监听页面加载
     */
    onLoad: function (options) {
        let query = options;
        this.setData({
            query:query,
            title:query.name
        });
        this.getArticleContent(query.id);
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
    getArticleContent:function(aid) {
        let _this = this;
        App.weiQinAppRequest("GetAtricleDetail", {aid:aid}, {
            success:function(datas) {
                let data = datas.data.data;
                _this.setData({
                    createTime: data.createTime,
                    readNum: data.readNum,
                    zanNum: data.zanNum,
                    showContent: data.showContent
                });
            }
        });
    }
})