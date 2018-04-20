//app.js
var qcloud = require('./vendor/wafer2-client-sdk/index')
var config = require('./config')
const AV = require('./utils/av-weapp.js');
const appId = "7tm1OFlNlmLFukegUhmm4uDU-gzGzoHsz";
const appKey = "XG4FRumQWJ7mNkFIral0ttvj";
AV.init({
  appId: appId,
  appKey: appKey
});

App({
    onLaunch: function () {
        qcloud.setLoginUrl(config.service.loginUrl)
        




        var that = this;
      //  AV.User.loginWithWeapp();
          // 调用登录接口
     



        // 设备信息
        wx.getSystemInfo({
          success: function (res) {
            that.screenWidth = res.windowWidth;
            that.screenHeight = res.windowHeight;
            that.pixelRatio = res.pixelRatio;
          }
        });

    }
})