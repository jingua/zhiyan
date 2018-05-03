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
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/H-ui.admin.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/lib/Hui-iconfont/1.0.7/iconfont.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/lib/icheck/icheck.css" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/skin/default/skin.css" id="skin" />
<link rel="stylesheet" href="/zhiyan/tp32/Public/static/h-ui/css/style.css" />
<title>知妍文化传播</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<!-- menu -->
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 
  	<span class="c-gray en">&gt;</span> 渠道管理
  	<span class="c-gray en">&gt;</span> 添加类型
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
  			<label class="form-label col-xs-4 col-sm-2" style="width:160px;">类型名称</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="" placeholder="请输入类型名称" 
  				id="type_name" name="type_name">
  			</div>
  		</div>

       <!-- text -->
      <div class="row cl">
        <label class="form-label col-xs-4 col-sm-2" style="width:160px;">排序</label>
        <div class="formControls col-xs-8 col-sm-9">
          <input type="text" class="input-text" value="0" placeholder="" 
          id="type_sort" name="type_sort">
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
<script src="/zhiyan/tp32/Public/lib/jquery/1.9.1/jquery.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/layer/2.1/layer.js"></script> 
<script src="/zhiyan/tp32/Public/lib/icheck/jquery.icheck.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/jquery.validate.min.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script src="/zhiyan/tp32/Public/static/h-ui/js/H-ui.js"></script> 
<script src="/zhiyan/tp32/Public/static/h-ui/js/H-ui.admin.js"></script> 
<script src="/zhiyan/tp32/Public/lib/jquery.form/jquery.form.js"></script> 




</body>
</html>

<!-- common -->
<script src="/zhiyan/tp32/Public/zhiyan/common/common.js"></script>

<script>
$("#type_name").focus();
var page_url = {
    'save_url' : "<?php echo U('Channel/type_add_save');?>",
    'list_url' : "<?php echo U('Channel/type_list');?>",
}
</script>