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
  	<span class="c-gray en">&gt;</span> 成员管理
  	<span class="c-gray en">&gt;</span> 添加成员
    <!-- 返回 -->
    <span class="c-gray en" 
        onClick="history.go(-1);" style="cursor:pointer;">&gt;&nbsp;&nbsp;返回
    </span> 
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
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">姓名</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="" placeholder="请输入姓名" 
  				id="member_name" name="member_name">
  			</div>
  		</div>

      <!-- select -->
      <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" style="width:160px;">性别</label>
            <div class="formControls col-xs-8 col-sm-9"> 
                <span class="select-box">
                    <select name="member_sex" id="member_sex" class="select">
                        <option value="1">男</option>
                        <option value="2">女</option>
                    </select>
                </span> 
            </div>
        </div>

        <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">手机号</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="" placeholder="请输入手机号" 
          id="member_tel" name="member_tel">
        </div>
      </div>

       <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">微信号</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="" placeholder="请输入微信号" 
          id="member_wachat" name="member_wachat">
        </div>
      </div>

       <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">邮箱</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="" placeholder="请输入邮箱" 
          id="member_email" name="member_email">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">账号</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="" placeholder="请输入账号" 
          id="member_user" name="member_user">
        </div>
      </div>

      <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">密码</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="password" class="input-text" value="" placeholder="请输入密码" 
          id="member_pass" name="member_pass">
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

       <!-- select -->
     <div class="row cl">
           <label class="form-label col-xs-4 col-sm-2" style="width:160px;">职位</label>
           <div class="formControls col-xs-8 col-sm-9"> 
               <span class="select-box">
                   <select name="role_id" id="role_id" class="select">
                       <?php if(is_array($role)): $i = 0; $__LIST__ = $role;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["role_id"]); ?>"><?php echo ($v["role_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                   </select>
               </span> 
           </div>
       </div>

      <!-- button -->
       <div class="row cl">
          <label class="form-label col-xs-4 col-sm-2" style="width:160px;"></label>
          <div class="formControls col-xs-8 col-sm-9">
          <button class="btn btn-primary radius btn_submit" type="button">
              <i class="Hui-iconfont">&#xe632;</i> 保存并提交
          </button>
          <button 
              onClick="history.go(-1);" class="btn btn-default radius" type="button">&nbsp;返回&nbsp;
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

<!-- common -->
<script src="/zhiyan/business_admin/Public/zhiyan/common/common.js"></script>

<script>
var page_url = {
    'save_url' : "<?php echo U('Member/member_add_save');?>",
    'list_url' : "<?php echo U('Member/member_list');?>",
}
</script>