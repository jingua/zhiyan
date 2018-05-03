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

<!-- content -->
<div class="page-container">
	<form method="post" class="form form-horizontal" action="#" 
    id="form-article-add" enctype="multipart/form-data">

      <!-- text -->
  		<div class="row cl">
  			<label class="form-label col-xs-4 col-sm-2" style="width:180px;">关系名称</label>
  			<div class="formControls col-xs-8 col-sm-9">
  				<input type="text" class="input-text" value="<?php echo ($res["parent_name"]); ?>" placeholder="请输入关系名称" 
  				id="parent_name" name="parent_name" style="width:360px">
  				<input type="hidden" name="member_id" value="<?php echo ($res["member_id"]); ?>">
  			</div>
  		</div>

      <!-- select -->
      <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2" style="width:180px;">选择成员</label>
            <div class="formControls col-xs-8 col-sm-9" style="width:388px;"> 
                <span class="select-box">
                    <select name="parent_id" id="parent_id" class="select">
                        <option value="">请选择成员</option>
                        <?php if(is_array($member)): $i = 0; $__LIST__ = $member;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><option value="<?php echo ($v["member_id"]); ?>" <?php if(($v["member_id"]) == $res["parent_id"]): ?>selected<?php endif; ?>><?php echo ($v["member_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
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
<script src="/zhiyan/tp32/Public/zhiyan/js/open.js"></script>

<script>
var page_url = {
    'save_url' : "<?php echo U('Member/member_parent_save');?>",
    'list_url' : "<?php echo U('Member/member_list');?>",
}
</script>