let App = getApp();

Component({
    properties:{

    },
    data: {
        windowWidth: App.globalData.windowWidth,
        direction:"top",
        showFromClass:"",
        loadTopImg:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACzUlEQVRYR+2WP4jTYBTA32uEU1Cog4ODi4PD6eAi4iLq4OLg0FZEBQWRo2rN+1IsKCjBAwVtL6+Ecocch4Ii98fBQcRBEAcRHFw8BxcHB8EbLKdD6TX3yVfSI+aSL2lPuOUyhZeX/H7fy3tfgrDOB64zHzYE1lQB0zQLiPiHmV8N+ioHFiCiaQA45YOnmfn0IBIDCRDREwA4GwI+ZeZz/Ur0LUBEjwDgfAzoMTNf6EeiLwHTNCcR8WIAMO+f7w3EJpn5UlqJ1AJENAEAI0G4YRjdHvA8bwYAViSklBP1er2YRiKVgBDClVJeDcNrtdoXFSuXy8NhCQBwmflakkSiABE5AEBx8F48SkJK6dTrdUsnoRUQQtyXUl5PguskEPGB4ziVOIlYASK6CwA30sJ1EgBwj5lvRklEChDRHQC4pYOXSqXhTCZzBRF/ep4367putx80PTHKzLfDEqsETNM8iIgfdHDLsvYsLy8/B4B9ft7npaWlXKPR+JogcZSZ3wYlVgkIIS5LKRt+0rwatV63q5gQYreUUsH3//MgxE+GYeSq1eo3jcQZZn6mFVAXTdMsI+JWwzBmg3DLsnb5Kz8Q01QfM5lMbmxs7HtQotPpqFfVZmaR+AriupWIdgKAWvmhXg4izqpzKWUhEHsvpcwz8w/d+K3kp0kqlUo7DMOYA4DDQbjjON2dUAgxE5QAgHee5+Vd111Ien7iRlQsFrcPDQ0p+LEoeC8WlkDEN61WqzA+Pv5LJ6EVqFQq29rttoIf18HjJADg9eLiYmFqaup3nESsgG3bm5vNpoKfSAPXSLzMZrN527ZbURKRArZtb/LhJ/uBayRe+BKdVFNARKq784PANRJzzLwyLbFT4P9oqu9791Cj1uv2pI4OX4+YjhFmfhjM027Fa4HHVCJ5K1Y3EtERANiylt/t4Cr9qi6EvwPdCvdb1v+dvyGw7hX4CxfnXjBiDfx9AAAAAElFTkSuQmCC",
        loadButtomImg:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAC1UlEQVRYR+2WPWgUQRTH37sVoqAQCwsLGwuLaGEjYiNqYWNhkbsgKiiIyKnn7uzhgYKyKChokn3HciRICAqKJBcLCxELQSxEsLBRCxsLC0ELQ7Q4LrcZeTIb1s3szt6dkCZX7d68ef/fvK8dhFX+4SrrwxqANgKO4xwAgA1E9Px/pMi27RIi/iCiV0l/KwBs296LiG/ZEBGbvu+P9AMhhJiVUpaUj4NJCB0A085Gov1AJMTZ5Tkiuhc/UFoKmgBQ7AdCIz5HRFEklhm0AJ7nrZufn58DgKO9QGjEnw4ODhY9z+sYayAy8DxvvYI40g2ERvyZEm/pailzDtRqtU3tdpsjcTgPhEb8xcLCQml6evpXWiEbB1G5XN48MDDAEIeyIJLiiPiy1WqVJiYmfmZ1kRGAN1cqlS2WZTHEfh2E5uSvwzAsBkHww9TCuQDYieM4WwHgCQDsi0Pwc6zPeXa8kVIWieibSfzvrNEZ2bZdRcSNlmU1x8bGPkU2rutuW1paYog9Kc7fFQqF4fHx8a/RerVaHep0OhcQsU1EwtgFQojzUsqGMvxoWdZIHEIIsV1KyRC7/xkoiO8tyxoeHR39EhcPw5CH2k7133Eiepw5iOKjOA3Cdd0dKhK7lM2HxcXF4Uaj8TlDnJfMo1jl+wYAXIuRrohEpVIZKhQKHNrvYRg2gyBYThWHPXFydnWTiK4bUxAZOI5zCwCuZEHo6iBF/DYRXdXZZ3aBEOKOlPJyXgidOCLe9X2/ltYRxjZ0HMfnLjRB6MSllH69Xnez2tEIwJuFEIGU8mIaRErYAyK6ZJoFuQBUYU7y9zwJwe/JgpNSTtbr9bJJnNdzA7CxbdtTiHgmDqGeoz7n1ykiOptHvGsAFYn7AHAqReABEZ3OK94TgIJ4CAAnEkKPiOhkN+I9AyiIGQCILqwzRHSsW/G+AFRN8AX2dz/X966KsJcTmvasAax6BP4ARTleMEHZn0AAAAAASUVORK5CYII=",
        allClickCss:{
            lx:{
                name:"类 型",
                list:{
                    i1:{
                        id:1,
                        title:"全部",
                        isCheck:"isClick"
                    },
                    i2:{
                        id: 2,
                        title:"推荐",
                        isCheck:""
                    }
                }
            },
            fl:{
                name:"分类",
                list:{
                    i1: {
                        id: 1,
                        title: "全部",
                        isCheck: "isClick"
                    },
                    i2: {
                        id: 2,
                        title: "编程代码",
                        isCheck: ""
                    },
                    i3: {
                        id: 3,
                        title: "生活琐事",
                        isCheck: ""
                    },
                    i4: {
                        id: 4,
                        title: "杂七杂八",
                        isCheck: ""
                    }
                }
            },
            fbsj:{
                name:"发布时间",
                list: {
                    i1: {
                        id: 1,
                        title: "全部",
                        isCheck: "isClick"
                    },
                    i2: {
                        id: 2,
                        title: "最近七天",
                        isCheck: ""
                    },
                    i3: {
                        id: 3,
                        title: "最近一个月",
                        isCheck: ""
                    },
                    i4: {
                        id: 4,
                        title: "最近三个月",
                        isCheck: ""
                    }
                }
            }
        },
        keyStr:""
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
            
        },
        hide: function () { },
        resize: function () { },
    },

    methods: {
        closeShowFrom:function(){
            let _this = this;
            _this.setData({

                showFromClass: _this.data.showFromClass == "" ? "showFormClose" : ""
            });
            setTimeout(function(){
                _this.setData({
                    direction: _this.data.showFromClass == "" ? "top" : "button"
                });
            }, 2000);
        },
        listBtnClick:function(e){
            let _this = this;
            let data = e.currentTarget.dataset;
            let types = data.type;
            let id = data.id;
            let allData = _this.data.allClickCss;
            let returnData = {};

            if (allData[types] != undefined) {
                for (let i in allData[types].list) {
                    allData[types]['list'][i].isCheck = "";
                    if (i == "i" + id) {
                        allData[types]['list'][i].isCheck = "isClick";
                    }
                }
                _this.setData({
                    allClickCss: allData
                });
            }
    
            for (let i in allData) {
                for (let j in allData[i]['list']) {
                    if (allData[i]['list'][j].isCheck != "") {
                        returnData[i] = allData[i]['list'][j]['id'];
                    }
                }
            }
            returnData['gjz'] = this.data.keyStr;
            _this.triggerEvent("scevent", returnData);
        },
        getInputData:function(e) {
            this.setData({
                keyStr:e.detail.value
            });
        }
    }
})