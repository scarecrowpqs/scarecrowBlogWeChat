// sc_blog/components/FrendCard/FrendCard.js
Component({
    /**
     * 组件的属性列表
     */
    properties: {
        imgHref:String,
        frendName:String,
        frendIntroduce:String,
        toLink:String
    },

    /**
     * 组件的初始数据
     */
    data: {
        showContent:"",
        showName:"",
        showIntroduce:""
    },
    observers:{
        'frendName':function(data) {
            let showContent = this.handleStr(data + (this.data.showIntroduce == "" ? "" : " ------ " + this.data.showIntroduce));
            this.setData({
                showName:data,
                showContent: showContent
            });
        },
        'frendIntroduce': function (data) {
            let showContent = this.handleStr(this.data.showName + (data == "" ? "" : " ------ " + data));
            this.setData({
                showIntroduce: data,
                showContent: showContent
            });
        }
    },
    /**
     * 组件的方法列表
     */
    methods: {
        switchTab:function() {
            wx.setClipboardData({
                data: this.properties.toLink,
                success:function() {
                    wx.showToast({
                        title: '地址复制成功',
                    })
                }
            })
        },
        handleStr: function (str, len = 35) {
            if (str.length <= len) {
                return str;
            }
            str = str.substr(0, len) + "......";
            return str;
        }
    }
})
