<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="stylesheet" type="text/css" href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/zhiyan/business_admin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/zhiyan/business_admin/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" type="text/css" href="/zhiyan/business_admin/Public/static/h-ui/skin/default/skin.css" id="skin" />

<link rel="stylesheet" type="text/css" href="/zhiyan/business_admin/Public/static/h-ui/css/style.css" />

<title>知妍文化传播</title>
<meta name="keywords" content="关键词,5个左右,单个8汉字以内">
<meta name="description" content="网站描述，字数尽量空制在80个汉字，160个字符以内！">
</head>
<body>
<header class="navbar-wrapper">
  <div class="navbar navbar-black navbar-fixed-top">
    <div class="container cl">
      <span class="logo navbar-slogan hidden-xs">知妍文化传播</span>
      <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
      <nav class="nav navbar-nav nav-collapse" role="navigation" id="Hui-navbar">
        <ul class="cl">
          <li><a href="#">核心</a></li>
          <li><a href="#">扩展</a></li>
          <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A">一级导航 <i class="Hui-iconfont">&#xe6d5;</i></a>
            <ul class="dropDown-menu menu radius box-shadow">
              <li><a href="#">二级导航</a></li>
              <li><a href="#">二级导航<i class="arrow Hui-iconfont">&#xe6d7;</i></a>
                <ul class="menu">
                  <li><a href="javascript:;">三级菜单<i class="arrow Hui-iconfont">&#xe6d7;</i></a>
                    <ul class="menu">
                      <li><a href="javascript:;">四级菜单</a></li>
                      <li><a href="javascript:;">四级菜单</a></li>
                      <li><a href="javascript:;">四级菜单</a></li>
                    </ul>
                  </li>
                  <li><a href="#">三级导航</a></li>
                </ul>
              </li>
              <li><a href="#">二级导航</a></li>
              <li class="disabled"><a href="javascript:;">二级菜单</a></li>
            </ul>
          </li>
          <li><a href="#">联系我们</a></li>
          <li><a href="http://127.0.0.1/zhiyan/tp32/index.php?s=/Admin/Index/login.html">后台入口</a></li>
        </ul>
      </nav>
      <nav class="navbar-userbar hidden-xs">
        
      </nav>
    </div>
  </div>
</header>
<nav class="breadcrumb">
  <div class="container">
    <i class="Hui-iconfont">&#xe67f;</i> 
    <a href="#" class="c-primary">首页</a>
    <span class="c-gray en">&gt;</span>
    <a href="#">组件</a>
    <span class="c-gray en">&gt;</span>
    <span class="c-gray">当前页面</span>
  </div>
</nav>
<section class="container">
  <h2>知妍文化传播</h2>
  <div class="line"></div>
  <form action="" method="post" class="form form-horizontal responsive" id="demoform">

    <div class="row cl">
      <label class="form-label col-xs-2">联系人</label>
      <div class="formControls col-xs-5">
        <input type="text" class="input-text" placeholder="联系人" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">联系人微信</label>
      <div class="formControls col-xs-5">
        <input type="text" class="input-text" placeholder="联系人微信" name="username" id="username" datatype="*4-16" nullmsg="用户名不能为空">
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">联系电话</label>
      <div class="formControls col-xs-5">
        <input type="text" class="input-text" autocomplete="off" placeholder="联系电话" name="username" id="username" datatype="m|e" nullmsg="账户不能为空">
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号名称</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号名称" name="password" id="password" datatype="*6-18" nullmsg="请输入密码！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号ID</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号ID" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-xs-2"></label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="请选择省市区" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-xs-2">公众号类型</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号类型" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">粉丝数量</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="粉丝数量" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号头条报价</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号头条报价" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号次条报价</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号次条报价" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>


    <div class="row cl">
      <label class="form-label col-xs-2">公众号头条阅读量</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号头条阅读量" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>
    
    <div class="row cl">
      <label class="form-label col-xs-2">公众号次条阅读量</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号次条阅读量" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号次条报价</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号次条报价" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号次条报价</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号次条报价" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">公众号次条报价</label>
      <div class="formControls col-xs-5">
        <input type="password" class="input-text" autocomplete="off" placeholder="公众号次条报价" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">单选框：</label>
      <div class="formControls skin-minimal col-xs-5">
        <div class="radio-box">
          <input type="radio" id="sex-1" name="sex" datatype="*" nullmsg="请选择性别！">
          <label for="sex-1">男</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-2" name="sex">
          <label for="sex-2">女</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-3" name="sex">
          <label for="sex-3">保密</label>
        </div>
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">爱好：</label>
      <div class="formControls skin-minimal col-xs-5">
        <div class="check-box">
          <input type="checkbox" id="checkbox-5" name="checkbox2" datatype="*" nullmsg="爱好不能为空！">
          <label for="checkbox-5">上网</label>
        </div>
        <div class="check-box">
          <input type="checkbox" id="checkbox-6" name="checkbox2">
          <label for="checkbox-6">摄影</label>
        </div>
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">附件：</label>
      <div class="formControls col-xs-5"> <span class="btn-upload form-group">
        <input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
        <a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
        <input type="file" multiple name="file-2" class="input-file">
        </span> </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">所在城市：</label>
      <div class="formControls col-xs-5"> <span class="select-box">
        <select class="select" size="1" name="demo1" datatype="*" nullmsg="请选择所在城市！">
          <option value="" selected>请选择城市</option>
          <option value="1">北京</option>
          <option value="2">上海</option>
          <option value="3">广州</option>
        </select>
        </span> </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">网址：</label>
      <div class="formControls col-xs-5">
        <input type="text" class="input-text" placeholder="http://" name="username" id="username" datatype="url" nullmsg="网址不能为空">
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-2">备注：</label>
      <div class="formControls col-xs-5">
        <textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-500" nullmsg="备注不能为空！" onKeyUp="textarealength(this,500)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/500</p>
      </div>
      <div class="col-xs-5"> </div>
    </div>

    <div class="row cl">
      <div class="col-xs-10 col-xs-offset-2">
        <input class="btn btn-primary" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>

  </form>

</section>

<footer class="footer mt-20">
  <div class="container">
    <p>知妍文化传播</p>
  </div>
</footer>
</body>
</html>

<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/layer/2.1/layer.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/laypage/1.2/laypage.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/My97DatePicker/WdatePicker.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/bootstrap-Switch/bootstrapSwitch.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/Validform/5.3.2/Validform.min.js"></script> 
<script type="text/javascript" src="/zhiyan/business_admin/Public/lib/Validform/5.3.2/passwordStrength-min.js"></script>
<script type="text/javascript" src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.js"></script>

<script>
var navigation = responsiveNav("Hui-navbar", {customToggle: ".nav-toggle"});
$(function(){
  $('.skin-minimal input').iCheck({
    checkboxClass: 'icheckbox-blue',
    radioClass: 'iradio-blue',
    increaseArea: '20%'
  });
  $("#demoform").Validform({
    tiptype:2
  });
});
</script>