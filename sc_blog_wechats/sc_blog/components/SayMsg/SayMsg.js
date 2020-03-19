// sc_blog/components/SayMsg/SayMsg.js
Component({
    /**
     * 组件的属性列表
     */
    properties: {
        userName:String,
        userImgHref:String,
        userSayStr:String,
        addTimes:String
    },

    /**
     * 组件的初始数据
     */
    data: {
        showUserName:""
    },

    observers:{
        "userName":function(data) {
            this.setData({
                showUserName:this.handleStr(data)
            });
        }
    },
    /**
     * 组件的方法列表
     */
    methods: {
        handleStr: function (str, len = 9) {
            if (str.length <= len) {
                return str;
            }
            str = str.substr(0, len) + "......";
            return str;
        },
    }
})
