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

$(function(){
  var flag = 1;
  $('.navmore').click(function(){
    if (flag == 1) {
      $('.aside').animate({'left':'-15%'});
      $('.section').animate({'width':'100%'});
      $('.navmoreImg').attr('src',getRealPath()+'/Public/crm/images/navmore2.png');
      flag = 0;
    }else if(flag == 0){
      $('.aside').animate({left:'0'});
      $('.section').animate({'width':'85%'});
      $('.navmoreImg').attr('src',getRealPath()+'/Public/crm/images/navmore1.png');
      flag = 1;
    }
  })
})


function accountManagement(){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/showTable';
}
function accountManagement2(){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/index';
}
function certification(){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/renList';
}
function MT4(){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/mt';
}
function login(){
  location.href = getRealPath()+'/zhonghui_admin.php/Login/logout';
}
function editadmin() {
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/editShow';
}
function showMoney() {
  location.href = getRealPath()+'/zhonghui_admin.php/Money/index';
}
function tixian() {
  location.href = getRealPath()+'/zhonghui_admin.php/Withdrawal/index';
}
function trading() {
    location.href = getRealPath()+'/zhonghui_admin.php/Csv/index';
}
function ConsultingList() {
    location.href = getRealPath()+'/zhonghui_admin.php/Calculate/getConsultingList';
}
function setCalculateCsv() {
    location.href = getRealPath()+'/zhonghui_admin.php/Calculate/showAdd';
}
function trading2() {
    location.href = getRealPath()+'/zhonghui_admin.php/Calculate/index';
}
function follow() {
    location.href = getRealPath()+'/zhonghui_admin.php/Follow/index';
}
function bindBank() {
    location.href = getRealPath()+'/zhonghui_admin.php/Bank/index';
}
function toVirtual() {
    location.href = getRealPath()+'/zhonghui_admin.php/Virtual/index';
}
function toreload() {
    location.reload();
}

function huiqu(){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/renList';
}
function lookthis(id) {
  var or = confirm("确认要通过实名认证么？");
  if(or){
    location.href = getRealPath()+'/zhonghui_admin.php/Crm/yanzheng_ok?user_id=' + id;
  }
}

function show_detail(id){
  location.href = getRealPath()+'/zhonghui_admin.php/Crm/show_detail?id=' + id;
}

function cancel(){
  $('.addAccount').css('display','none');
}


function addAside(){
  var asideStr = '<li class="controlGroup" data-flag="2">用户管理            <ul>              <li class="control" onclick="accountManagement()">用户列表</li>              <li class="control" onclick="accountManagement2()">用户关系树</li>              <li class="control" onclick="certification()">实名认证申请管理</li>              <li class="control" onclick="MT4()">MT4帐号申请管理</li>              <li class="control" onclick="ConsultingList()">交易员信息表</li>              <li class="control" onclick="bindBank()">银行卡绑定管理</li>            </ul>          </li>          <li class="controlGroup" data-flag="2">业务管理            <ul>              <li class="control" onclick="follow()">跟随管理</li>              <li class="control" onclick="noThis()">租用管理</li>            <li class="control" onclick="toVirtual()">虚拟帐号管理</li>            </ul>          </li>          <li class="controlGroup" data-flag="2">数据管理            <ul>              <li class="control" onclick="trading()">跟单记录</li>              <li class="control" onclick="noThis()">租用记录</li>              <li class="control" onclick="trading2()">交易记录</li>            </ul>          </li>          <li class="controlGroup" data-flag="2">佣金管理            <ul>              <li class="control" onclick="showMoney()">佣金详情表</li>              <li class="control" onclick="tixian()">提现管理</li>            </ul>          </li>          <li class="controlGroup" data-flag="2">系统管理            <ul>              <li class="control" onclick="editadmin()">帐号设置</li>            </ul>          </li>';
  $('.controlList').html(asideStr);
}

addAside();

function showThis(obj,num){
  $('.control').eq(obj).addClass('checked');
  $('.controlGroup').eq(num).attr('data-flag','1');
  $('.controlGroup').eq(num).addClass('check')
  var controlList = $('.controlGroup');
  for (var i = controlList.length - 1; i >= 0; i--) {
    if(controlList[i].getAttribute('data-flag') == 2){
      var $this = $(controlList[i]);
      $this.find('ul').css('display','none')
    }
  }
}

$(".controlGroup").click(function(){
  if($(this).attr('data-flag') == '1'){
    $(this).find('ul').slideUp(500);
    $(this).attr('data-flag','2');
  }else if($(this).attr('data-flag') == '2'){
    $(this).siblings().attr('data-flag','2');
    $(this).siblings().find('ul').slideUp(500);
    $(this).find('ul').slideDown(500);
    $(this).attr('data-flag','1');
  }
})

function noThis(){
  alert('功能开发中');
}

function showThisStr(str){
  var showThis_obj = '';
  var showThis_num = '';
  var controlList = $('.control');
  for(var i = 0; i < controlList.length; i++){
    if(controlList[i].innerHTML == str){
      console.log(i);
      showThis_obj = i;
    }
  }
  if(controlList[showThis_obj] == '用户列表' || controlList[showThis_obj] == '用户关系树' || controlList[showThis_obj] == '实名认证申请管理' || controlList[showThis_obj] == 'MT4帐号申请管理' || controlList[showThis_obj] == '交易员信息表' || controlList[showThis_obj] == '银行卡绑定管理'){
    showThis_num = 0;
  }else if(controlList[showThis_obj] == '跟随管理' || controlList[showThis_obj] == '租用管理' || controlList[showThis_obj] == '虚拟帐号管理'){
    showThis_num = 1;
  }else if(controlList[showThis_obj] == '跟单记录' || controlList[showThis_obj] == '租用记录' || controlList[showThis_obj] == '交易记录'){
    showThis_num = 2;
  }else if(controlList[showThis_obj] == '佣金详情表' || controlList[showThis_obj] == '提现管理'){
    showThis_num = 3;
  }else if(controlList[showThis_obj] == '帐号设置'){
    showThis_num = 4;
  }
  showThis(showThis_obj,showThis_num);
}