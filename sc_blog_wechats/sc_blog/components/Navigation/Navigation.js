// sc_blog/components/Navigation/Navigation.js
Component({
  /**
   * 组件的属性列表
   */
  properties: {
    navHeight:String,
    titlePostion:String,
    showFontSize:{
      type:String,
      value:"15"
    },
    backgroundColor:{
      type:String,
        value:"#e6e6e6"
    },
    showReturnIcon:{
      type:String,
      value:"false"
    },
    showFontColor:{
      type:String,
      value:"black"
    },
    showTitleContent:{
        type:String,
        value:""
    }
  },

  /**
   * 组件的初始数据
   */
  data: {
    returnIcon:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACTUlEQVRYR+2VMWhTURSG//MgwUGlQwfBoeqQhPfuTYSAg4NYC6KD4FAcBKGDoIOCo5t1dHFQwUFKp9ZBqovgpHUVN9+5L8lWHHRvRQIh98iRBNImaV6TJll64fKGd877v3fuf88hTHnRlPVxBDCwAuVyOVOv19eJaJaZ5w/7yPYFyOfzJzKZzBqAGwDeMfOtiQHkcrnZbDar4lfHJa4/07MCpVLpdLPZXAdwaZziPQGstedE5C2AC+MW7wKIoigkIhUvqjgAd9AzF5FtIvrmvf+RJMmfQfm7jsAY8wTA8qCklO8bAL6LyHPn3Ea/nF0AYRhGQRBocH7YChDRjIhcBnC+LSoir5xzD3tBdJnQWlsWEYWYG8UDxWIx771/BOB+S3iDmRf3QvS8BcaYiwAU4tQoECrW8lXbS/PM/LUTom8jiqLoChEpxMwhQOi3PqsnGo3GQq1W22lD7NsJrbXXReQ9gGOjQhhj3gC4q5uZV1IBaJC19qaIfBCRLefc2ZQ3oCssDMOlIAhWAawws4L8XwOHkQYVCoUz+qxWq1vDArS9QEQujmNzIIBhRTvzWoNtG8AOM5+cOIAxRnvDJhF9ieN4YeIA1toHIvJSRJ455x5PA+CTiFwTkcXO1pzKhKN6wBij3fC1Dro4jm+nakSjirbzOwec934uSZKfYwUIw/B4EAQ6znXfAaBtXdcyMz9NNQv2BkVRtEpES8NURUR+EdE9Zv7YKz+VB4wxmwD0GqVZf0WkRkQ17Z7e+xeVSuV3v8RUAGlUh405AjiqwD9jbeIh5uYY9QAAAABJRU5ErkJggg=="
  },

  /**
   * 组件的方法列表
   */
  methods: {
    backPage:function(){
      wx.navigateBack({
        delta:1
      })
    }
  }
})
