// sc_blog/components/SendMsg/SendMsg.js
Component({
    /**
     * 组件的属性列表
     */
    properties: {

    },

    /**
     * 组件的初始数据
     */
    data: {
        msgimg:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACRklEQVRYR+2XMU8UURDH/zOL2pAAi43aaI49QyKNiRZU0mgv0UTjF+D2LtFI79ljNLnb4wsYTSDaa4MVhSY2mBBvuUijNrJAco3KvjFvuT13AS+77MEV3it35838Zt7MezOEHi/qsX0cCDBUdS8bjByAcyAMZYIUbAP46is0tovWx7269gGMOmtFRTJHwKlMhvdsFuAnC81u2GPV6K8YgOm410F4EwgQyqRkxVfkZQExWExhmoCgHOgR3PBs622osw0wUlmdIGNgGcCgV7COJDfMmisAmuLvTG6Wxld2/WytEadxh0i90J57M9bjLF7/a6857z7SkRDhu5t27mUMwHQ+PwTxXPRntyHaToqa9eyLT+IALTrlY2qrZL1LYnx4fvW8ltuaGV9PJF9xr7GBpWiU20cQhicNgFlb+6INe4WxCz0CCJIKSZN2uPsR6AP8DxE4XW3kFfvPAbqSJNP/ysgHVsa9H8VcPfx2qCTUtc5yYgmQoOaTL1pX9HsqekccCqCTwdbd3i/DfgR6GYH6+923IH81SXV0vQr0HaENR2u9E0hngJp7H8BTEpnesPOvk3iUVmbUqd8UolcAHngF61m8Iam5twAsHEdLBuC2V7AWYwB6FmDGsm7Hk77vaSOgLy7dniuFyXBGiHW/eiYQkkqgmFAWxXVR6ntaQ1F5Yj5DrPJhW05CpehssK/9bs0G+pwGsxg+YG8TgunoTBA7gugGPSOAT14i7JwFczYQpZqCgW9Qvz6Fs0AsQl32MrW6I5mA0lD8AYYgtTB13VENAAAAAElFTkSuQmCC",
        zfjimg:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACUAAAAgCAYAAACVU7GwAAADeUlEQVRYR82WTWhcVRTHz3kzmDRDQFwotJskVVdVIthCSkpb+xEMxNZEhygpSpMUS9pZzTsvExDeIjRz733ZJK0ggtCFC8VGcOMiokvBhQtFF6JUuuiiXbSL8hgsd0454U2YzuebzkvTAwOPueec+3vn/N+5F+EZMaXUIQCYY+Zl3G0mY8wIM88BwHkAuElEQ7sGFQTBqLV2DhE/qirMl0Q0+9ShtNZHpU0AMFPbJWae8Tzvq6cGZYx5K2rTB80kw8z7PM+7veNQSqlTUhlEzLbSLzP/43neK+KzY1BBEIyVy+V5AJiK+TF9TkSf7AiU1nocAATmbEyYits0EX2dKJQxZoKZBWaiBczbAPANAPTX+vT29r6Yy+XuJgKllDqLiAIjFWplLwPAFwBwvMFXt62nrqCCIJi01l5AxLF2bQrDsCeTySwzs9vE9xoRXaqsdSx0rfX7AHABAE62gwGAh0T0nDEmy8xbemlkjuNM5fP5jY6hisXitOM4AlNX/iZ7/UlEB4rF4muO4/ze6gWstS8UCoV7saGMMR8ys8DIJI5r3xHRpDEmw8wPWgVVz6e2UEqpc1IZZh6NSxL5aSLy5FlrXY4xC9eJKFe9R52mtNYfR5oZ6RAGEPGy67pXI6BfAeBguxzMfMbzvO8bQimlZhFR2iT3miex94joRgT0GQBcjJMkk8n0LywsPNZiNMbMR5p5M06SRj6IeNh13V8ioDwAmDi5GulJ4rbat7a21lMqlaRK8jsQJ2HFx1o7WCgU/ouA5Jz7toP4Oj1tQ9UmiWaR3HdkSqebbHI/DMOXfN//X9ZXV1ffsNb+1gEQOI4zns/nf6iNaTs8tdZHmHlSABHx1SjBH0T0eiWZ7/vP9/X1bc+ZuGBhGO7xfb/UMVR1gNZ6v8AR0Xr1/0qpfxFxKC6M+DXTU9P2dZJcay0j4F0A2NtJHAA01FMiUBUQrfUwALwTAcpzSyuXy+OLi4t1euoaamVl5Vg6nf7Ldd07NW0eZuZjiCgfilyH62xgYCCdzWZto7W2Qm/1ugKVSqU2EHGTmTettT9WxkN1BSNAOTtPA0BfKz0lUqlUKvVzBYCZr3ueJ8dUQ5MWR4BDtedddUASlapA3QrDcND3fTmEu7LEoBDxhOu6P3VFEwUnBbVMRJ8mAZSUpq4Q0eGkgBKBYubbS0tLfycJ9QjUM1zmk2NXrAAAAABJRU5ErkJggg==",
        closeimg:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEMklEQVRYR8VXUWgcVRQ9903ys9W/SlFQ1EoF/RC0Wq2oFamKohjUfBSNfrVYqRCz82YDgiMo2X2za1BR2v30Q8FaWiuKTRFri9XGKiootFgVhUqxf7qTj2TelRtmZHZ2dmc2DfhgIGTvu/e8d8+971zCEGtmZmaLUmqMiG4DcEn8iYe/5GPmL621+6enp4+UdUtFhrOzs5cuLS1tt9ZuI6INRfbyOzOfVkq9MzIy0p6cnPxz0J6BAIIgeJGZtwO4LHYyB+Cwtfa4UupcGIbn5P+VSmWdtXadUmozgK0A7o3tzxJR23Xdl/qB6AvAGHMUwB3xxrZSql2tVr8pcwPNZvMma60Al0/WMa31nXl7cwEYYySnawHMK6V2lg2cDRADeQvALQDOa62FN12rB4Ax5lcAVxLRh67rPlzmxEU2QRAcZOaHAPymtb4qbd8FwBjzHoDHAcxqrZ8vcjzM78aYVwFMAtirtR5P9v4HICacD+CA1npsGOdlbY0x+wE8QkR+QsxlAFJqi4uLJ4XtSqmNK815EZCYExLn7Ojo6EYp0WUAqdO3tdY7csh0XRRFzy4sLOzyfd8OCtRsNsV2l+M4b1Sr1Z+ytsaYPVIdyS0sA2g0GmeI6Op+p280Gm8S0U5JDxE94bpuJw+EBLfWCo+uZ+bdnuc906cyTjLzL57nrSdjzAMAPhpUq77vq0qlsk/yB+ATpdST1Wr1fNp5OjiAH5VS43k3IHtSPeZBAbAbwI40MfJOFwTBGmZ+H8D9AI44jjMxNTX1h9gOEzyT8j0CYB7Azdba22u12vGC/K611u4FsAXAV47jPMXMI8m1F5088V2v1zcrpb4A8LUAWG48AK7RWp8pYnKr1bo8iiLJ861E9L0AkJyXDR6nYD2An6UxCYB/AKwJw/Bi3/fl78LVarU2yKmZ+YbYeGDOsw5937+oUqn8DaCzWgB+YOZxz/NOFaIHkAUwVArq9foVSilJwaZMCuYdx3ksIeYgIMaYrhQMS0KphLsAnJBKSJOQiI4S0aPZEs2C6SJho9F4jYieA+BqrZv9kEsZAtjHzPcB+NxaO1Gr1X7PKcO5MAzHfN8P+/kyxlSlATPz6yQ6z3GczwDMaa3Fec9KNyIiOiTdcFAjIqIPXNeVppW7jDGHRDVFUXR30opPid7r14qDIDDM7A7TigG8q7XeNqAVn/Y879rSjxEzP93pdGplHiNr7StE9F2eFsx9jP735zjTn+e11pvK1POwNsaYE6IPewRJ4ih5pVZTDya+U7qwSyHnidJEEa+aLkzpwR5l3E+WJ93xgFLq5ZVKtFiCvRDriB5FLLczaDBJFLLYXehg0qWE09wZdjQ7RkSfRlF0OG80cxxnKzPfk5qoVj6aJShTw+mE6MYyzBe9p5R6+4KH02ywWD/KtHRj3ngO4FsAB7XWH5cBKjb/AhOmjkxf+gDcAAAAAElFTkSuQmCC",
        isShowImg:true,
        isShowSendForm:false,
        sendMsgData:""
    },

    /**
     * 组件的方法列表
     */
    methods: {
        clickSendMsg:function() {
            this.setData({
                isShowImg:false,
                isShowSendForm:true
            });
        },
        clickCloseSendForm:function(){
            this.setData({
                isShowImg: true,
                isShowSendForm: false
            });
        },
        getInputData:function(e){
            this.setData({
                sendMsgData:e.detail.value
            });
        },
        sendMsg:function() {
            let _this = this;
            _this.triggerEvent("scSendMsgEvent", _this.data.sendMsgData);
            _this.setData({
                sendMsgData:""
            });
        }
    }
})
