let App = getApp();
Component({
    data: {
        selected: 0,
        color: "#7A7E83",
        selectedColor: "#3cc51f",
        list: App.menuList,
    },
    attached() {
    },
    methods: {
        switchTab(e) {
            let data = e.currentTarget.dataset
            let url = data.path
            wx.switchTab({url})
        }
    }
})