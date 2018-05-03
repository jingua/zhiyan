function getRealPath() {//获取当前路径
    //获取当前网址，如： http://localhost:8083/myproj/view/my.jsp
    var curWwwPath = window.document.location.href;
    //获取主机地址之后的目录，如： myprojiew/my.jsp
    var pathName = window.document.location.pathname;
    var pos = curWwwPath.indexOf(pathName);
    //获取主机地址，如： http://localhost:8083
    var localhostPaht = curWwwPath.substring(0, pos);
    //获取带"/"的项目名，如：/myproj
    var projectName = pathName.substring(0, pathName.substr(1).indexOf('/') + 1);
    //得到了 http://localhost:8083/myproj
    var realPath = localhostPaht + projectName + '/';
    // console.log('realPath:' + realPath)
    // return realPath;
    return localhostPaht;
};

// $(function(){
//   var flag = 1;
//   $('.navmore').click(function(){
//     if (flag == 1) {
//       $('.aside').animate({'left':'-15%'});
//       $('.section').animate({'width':'100%'});
//       $('.navmoreImg').attr('src',getRealPath()+'/Public/crm/images/navmore2.png');
//       flag = 0;
//     }else if(flag == 0){
//       $('.aside').animate({left:'0'});
//       $('.section').animate({'width':'85%'});
//       $('.navmoreImg').attr('src',getRealPath()+'/Public/crm/images/navmore1.png');
//       flag = 1;
//     }
//   })
// })


function userManagement(){
  // location.href = getRealPath()+'/zhonghui_admin.php/Crm/showTable';
  location.href = 'userManagement.html';
}
function figure(){
  location.href = 'figure.html';
}
function CommodityManagement(){
  location.href = 'CommodityManagement.html';
}
function orderManagement(){
  location.href = 'orderManagement.html';
}
function accountManagement() {
  location.href = 'accountManagement.html';
}
function login(){
  location.href = getRealPath()+'/zhonghui_admin.php/Login/logout';
}
function addAccount() {
  location.href = 'addAccount.html';
}
function addRole() {
  location.href = 'addRole.html';
}
function roleManagement() {
  location.href = 'roleManagement.html';
}
function AppointmentBooking() {
    location.href = 'AppointmentBooking.html';
}
function StoreManagement() {
    location.href = 'StoreManagement.html';
}
function homeManagement() {
    location.href = 'homeManagement.html';
}
function CommodityParameter() {
    location.href = 'CommodityParameter.html';
}
function addStore() {
    location.href = 'addStore.html';
}
function orderDetails() {
    location.href = 'orderDetails.html';
}
function addCommodity() {
    location.href = 'addCommodity.html'
}
function toreload() {
    location.reload();
}/*
window.history.go(-1);  //返回上一页
window.history.back();  //返回上一页
window.history.back();location.reload();//强行刷新
 
window.location.go(-1); //刷新上一页
*/
function toback(){
  window.location.go(-1);
}

function addAside(){
  var asideStr = '<li class="controlGroup" onclick="userManagement()"><span class="icon_list icon1"></span>用户管理</li>'+
          '<li class="controlGroup" onclick="figure()"><span class="icon_list icon2"></span>轮播图管理</li>'+
          '<li class="controlGroup" onclick="CommodityManagement()"><span class="icon_list icon3"></span>商品管理</li>'+
          '<li class="controlGroup" onclick="orderManagement()"><span class="icon_list icon4"></span>订单管理</li>'+
          '<li class="controlGroup" onclick="homeManagement()"><span class="icon_list icon5"></span>首页楼层管理</li>'+
          '<li class="controlGroup" onclick="StoreManagement()"><span class="icon_list icon6"></span>门店及人员管理</li>'+
          '<li class="controlGroup" onclick="AppointmentBooking()"><span class="icon_list icon7"></span>预约信息查看</li>'+
          '<li class="controlGroup" onclick="accountManagement()"><span class="icon_list icon8"></span>后台账号管理</li>';
  $('.controlList').html(asideStr);
}

addAside();

function showThis(obj){
  var obj = obj;
  var controlList = $('.controlGroup');
  var showThis_index = '';
  for(var i = 0; i < controlList.length; i++){
    var str = controlList[i].innerHTML;
    var str2 = str.slice(str.indexOf('</span>')+7);
    if(str2 == obj){
      showThis_index = i;
    }
  }
  controlList.eq(showThis_index).addClass('check')
}


// function showThis(obj,num){
//   $('.control').eq(obj).addClass('checked');
//   $('.controlGroup').eq(num).attr('data-flag','1');
//   $('.controlGroup').eq(num).addClass('check')
//   var controlList = $('.controlGroup');
//   for (var i = controlList.length - 1; i >= 0; i--) {
//     if(controlList[i].getAttribute('data-flag') == 2){
//       var $this = $(controlList[i]);
//       $this.find('ul').css('display','none')
//     }
//   }
// }

// $(".controlGroup").click(function(){
//   if($(this).attr('data-flag') == '1'){
//     $(this).find('ul').slideUp(500);
//     $(this).attr('data-flag','2');
//   }else if($(this).attr('data-flag') == '2'){
//     $(this).siblings().attr('data-flag','2');
//     $(this).siblings().find('ul').slideUp(500);
//     $(this).find('ul').slideDown(500);
//     $(this).attr('data-flag','1');
//   }
// })

// function noThis(){
//   alert('功能开发中');
// }

// function showThisStr(str){
//   var showThis_obj = '';
//   var showThis_num = '';
//   var controlList = $('.control');
//   for(var i = 0; i < controlList.length; i++){
//     if(controlList[i].innerHTML == str){
//       showThis_obj = i;
//     }
//   }
//   if(controlList[showThis_obj].innerHTML == '用户列表' || controlList[showThis_obj].innerHTML == '用户关系树' || controlList[showThis_obj].innerHTML == '实名认证申请管理' || controlList[showThis_obj].innerHTML == 'MT4帐号申请管理' || controlList[showThis_obj].innerHTML == '交易员信息表'){
//     showThis_num = 0;
//   }else if(controlList[showThis_obj].innerHTML == '跟随管理' || controlList[showThis_obj].innerHTML == '租用管理' || controlList[showThis_obj].innerHTML == '虚拟帐号管理'){
//     showThis_num = 1;
//   }else if(controlList[showThis_obj].innerHTML == '跟单记录' || controlList[showThis_obj].innerHTML == '租用记录' || controlList[showThis_obj].innerHTML == '交易记录'){
//     showThis_num = 2;
//   }else if(controlList[showThis_obj].innerHTML == '佣金详情表' || controlList[showThis_obj].innerHTML == '提现管理'){
//     showThis_num = 3;
//   }else if(controlList[showThis_obj].innerHTML == '帐号设置'){
//     showThis_num = 4;
//   }
//   showThis(showThis_obj,showThis_num);
// }