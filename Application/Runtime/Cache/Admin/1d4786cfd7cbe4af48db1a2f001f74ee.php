<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" 
content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="/zhiyan/business_admin/Public/static/h-ui/css/style.css" />
<title>知妍文化传播</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<!-- menu -->
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 
  	<span class="c-gray en">&gt;</span> 个人设置
  	<span class="c-gray en">&gt;</span> 个人信息修改
    <!-- 刷新 -->
  	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" 
  	href="javascript:location.replace(location.href);" title="刷新" >
  	<i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">旧密码</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="password" class="input-text" value="" placeholder="请输入旧密码" 
  				id="old_pass" name="old_pass">
  			</div>
  		</div>

        <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">新密码</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="password" class="input-text" value="" placeholder="请输入新密码" 
          id="new_pass" name="new_pass">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">确认密码</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="password" class="input-text" value="" placeholder="请输入确认密码" 
          id="repass" name="repass">
        </div>
      </div>

      <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
          </div>
      </div>
	</form>
</div>
<script src="/zhiyan/business_admin/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/layer/2.1/layer.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.js"></script> 
<script src="/zhiyan/business_admin/Public/static/h-ui/js/H-ui.admin.js"></script> 
<script src="/zhiyan/business_admin/Public/lib/jquery.form/jquery.form.js"></script> 




</body>
</html>



<script>

/*top.location.href="<?php echo U('Index/login');?>";*/

var is_submit = 0;
$(".btn_submit").on("click", function(){
if(is_submit == 1) return;
is_submit = 1;
$("#form-article-add").ajaxSubmit({
      url: "<?php echo U('Member/member_pass_save');?>",
      type: "POST",
      dataType: "json",
      beforeSend: function() {
      },
      error: function() {
        layer.alert("服务器超时，请稍后再试",{icon:2,time:1000});
        is_submit = 0;
      },
      success:function(data){
        if(data.ok == 200){
          layer.alert(data.info,{icon:1,time:1000});
          setInterval(function(){  top.location.href="<?php echo U('Index/login');?>"; },1000);
        }else{
          layer.alert(data.info,{icon:2,time:1000});
        }
        is_submit=0;
      }
    });
});
</script>