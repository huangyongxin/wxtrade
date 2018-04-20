/**
 *
 * 配套视频教程请移步微信->小程序->灵动云课堂
 * 关注订阅号【huangxiujie85】，第一时间收到教程推送
 *
 * @link http://blog.it577.net
 * @author 黄秀杰
 */

var qcloud = require('../../../vendor/wafer2-client-sdk/index')
var config = require('../../../config')

const AV = require('../../../utils/av-weapp.js')
var app = getApp()
Page({
  navigateToAddress: function () {
    wx.navigateTo({
      url: '../../address/list/list'
    });
  },
  navigateToOrder: function (e) {
    var status = e.currentTarget.dataset.status
    wx.navigateTo({
      url: '../../order/list/list?status=' + status
    });
  },
  logout: function () {
    AV.User.logOut();
    wx.showToast({
      title: '退出成功'
    });
    this.setData({
      userInfo: ''
    });
  },
  onShow: function () {

  this.login();
  },
  chooseImage: function () {
    var that = this;
    wx.chooseImage({
      count: 1, // 默认9
      sizeType: ['original', 'compressed'], // 可以指定是原图还是压缩图，默认二者都有
      sourceType: ['album', 'camera'], // 可以指定来源是相册还是相机，默认二者都有
      success: function (res) {
        // 返回选定照片的本地文件路径列表，tempFilePath可以作为img标签的src属性显示图片
        var tempFilePath = res.tempFilePaths[0];
        new AV.File('file-name', {
          blob: {
            uri: tempFilePath,
          },
        }).save().then(
          // file => console.log(file.url())
          function (file) {
            // 上传成功后，将所上传的头像设置更新到页面<image>中
            var userInfo = that.data.userInfo;
            userInfo.avatarUrl = file.url();
            that.setData({
              userInfo, userInfo
            });
          }
          ).catch(console.error);
      }
    })
  },
  navigateToAboutus: function () {
    wx.navigateTo({
      url: '/pages/member/aboutus/aboutus'
    });
  },
  navigateToDonate: function () {
    wx.navigateTo({
      url: '/pages/member/donate/donate'
    });
  },
  navigateToShare: function () {
    wx.navigateTo({
      url: '/pages/member/share/share'
    });
  },

  // 用户登录示例
  login: function () {
    //if (this.data.logged) return

    //util.showBusy('正在登录')
    var that = this

    // 调用登录接口
    qcloud.login({
      success(result) {
        if (result) {
         // console.log(123);
          //console.log(result);
          that.setData({
            userInfo: result,
          //  logged: true
          })
        } else {
          // 如果不是首次登录，不会返回用户信息，请求用户信息接口获取
          qcloud.request({
            url: config.service.requestUrl,
            login: true,
            success(result) {
            //  console.log(456);
           //   console.log(result);
              that.setData({
                userInfo: result.data.data,
               // logged: true
              })
            },

            fail(error) {
              util.showModel('请求失败', error)
              console.log('request fail', error)
            }
          })
        }
      },

      fail(error) {
        util.showModel('登录失败', error)
        console.log('登录失败', error)
      }
    })
  },




})